<?php

namespace App\Http\Controllers;

use App\Mail\CelloRecordingServices;
use App\Mail\Messages;
use App\Mail\Quote as MailQuote;
use App\Models\Admin;
use App\Models\Conversation;
use App\Models\Delivery;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('admin',['except' => 'page_admin']);
    }

    public function connection_admin() {
        return view('dashboard_admin');
    }

    public function page_admin()
    {
        return view('admin.admin_connection');
    }

    public function page_admin_logout(Request $request)
    {
        /*On détruit les variables de Session*/
        $request->session()->forget('admin_name');
        $request->session()->forget('admin_password');
        return redirect('/');
    }
    
    public function page_dashboard()
    {
        $nb_users = count(User::all());
        $nb_orders_delivered = count(Order::where('status', '1')->get());
        $nb_orders_canceled = count(Order::where('status', '2')->get());
        $nb_orders_waiting = count(Order::where('status', '3')->get());
        $nb_orders_revision = count(Order::where('status', '4')->get());
        $nb_orders_completed = count(Order::where('status', '5')->get());

        $admin_name = Admin::find(1)->name;

        return view('admin.dashboard', compact('admin_name', 'nb_users', 'nb_orders_waiting', 'nb_orders_completed', 'nb_orders_revision', 'nb_orders_canceled', 'nb_orders_delivered'));
    }

    public function page_quotes()
    {
        return view('admin.quotes');
    }

    public function page_quote_form($user_id)
    {
        $user_name = User::find($user_id)->name;
        return view('admin.quote_form', compact('user_id', 'user_name'));
    }

    public function page_quotes_sent()
    {
        $quotes = Quote::all();
        return view('admin.quote_sent', compact('quotes'));
    }

    public function page_list_conversation_admin()
    {
        $notifs_which_user = Notification::where('from', '!=', 'Christophe Luciani')
            ->where('nb_notif', '!=', 0)->get();

        /* On sélectionne le nombre de conversations en cours : toutes les entrées qui ne correspondent pas à un expéditeur Admin et qui pour leur user_id sont uniques.  */

        $conversations = Message::select('user_id', 'from')->where('from', "!=", "Christophe Luciani")->distinct()->get();

        $nb_notifications = Notification::where('to', 'Christophe Luciani')->sum('nb_notif');

        return view('admin.list_conversation_admin', compact('nb_notifications', 'conversations', 'notifs_which_user'));
    }

    public static function notifications()
    {
        $nb_notifications = Notification::where('to', 'Christophe Luciani')->sum('nb_notif');
        return $nb_notifications;
    }

    public function conversation_with_user($user_id)
    {

        /* Lors de l'ouverture de la conversation, on fait disparaître le nb de notifications de la relation ADMIN -> USER si la relation existe entre les deux */

        $user = User::where('id', $user_id)->first();
        $user_name =  $user->name;

        $notifications_exist = Notification::where('from', $user_name)
            ->where('to', 'Christophe Luciani')->first();

        if ($notifications_exist) {
            $notifications_exist->nb_notif = 0;
            $notifications_exist->save();
        }

        /**********************************************/
        /**********************************************/
        /**********************************************/
        /**********************************************/



        $messages = Message::where('user_id', $user_id)->get();
        $user = User::find($user_id);

        return view('admin.conversation_with_user', compact('messages', 'user'));
    }

    public function new_conversation_admin(Request $request, $user_id)
    {
        $request->validate([
            'message' => 'required',
        ]);

        /* VARIABLES */
        $admin_id = Admin::find(1)->id;
        $from =  Admin::find(1)->name;
        $to = User::find($user_id)->name;
        $message = $request->message;

        $datas_messages = [
            'content' => $message,
            'user_id' => $user_id,
            'from' => $from,
            'to' => $to,
            'admin_id' => $admin_id,
            'type' => 'message',
        ];

        /*Création du nouveau message*/
        Message::create($datas_messages);

        /*On incrémente de 1 la relation Admin->User dans la table Notification*/
        $notifications = Notification::where('from', $from)
            ->where('user_id', $user_id)->first();
        $notifications->nb_notif += 1;
        $notifications->save();

        /*Pour le mail*/
        $email_user = User::find($user_id)->email;
        $admin_name = Admin::find(1)->name;
        $url_redirection = "http://cellorecording.ml/conversation";

        /*On envoie un mail à l'utilisateur*/
        Mail::to($email_user)->send(new Messages($admin_name, $notifications->nb_notif, $url_redirection));

        return redirect()->back();
    }

    public function send_quote_client(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'nb_days' => 'required',
            'price' => 'required',
            'user_id' => 'required',
        ]);

        $datas = $request->all();
        $datas['price'] = $request->price * 100;

        Quote::create($datas);

        /*Pour le mail*/
        $email_user = User::find($request->user_id)->email;
        $user_name = User::find($request->user_id)->name;
        $admin_name = Admin::find(1)->name;

        $url_redirection = "http://cellorecording.ml/quotes_received";

        /*On envoie un mail à l'utilisateur*/
        Mail::to($email_user)->send(new MailQuote($admin_name, $user_name, $datas, $url_redirection));

        return redirect('dashboard_admin')->with('quotesent', 'The quote has been successfully sent to the client !');
    }

    public static function quotes_notifications()
    {
        $nb_quote = count(Quote::all());
        return $nb_quote;
    }

    public function page_paypal_payment(Request $request, $quote_id, $price)
    {
        $user_id = auth()->user()->id;
        $quote = Quote::where('user_id', $user_id)->where('id', $quote_id)->where('price', $price)->first();

        if (!$quote) {

            return view('page_error');
        } else {

            /* Variable de session pour conserver l'ID de la "quote" */

            if (($request->session()->has('quote_ready_payment'))) {

                $request->session()->forget('quote_ready_payment');
                $request->session()->push('quote_ready_payment', $quote->id);
            } else {
                $request->session()->push('quote_ready_payment', $quote->id);
            }

            return view('admin.paypal_payment', compact('quote'));
        }
    }


    public static function order_notifications()
    {
        $nb_order = count(Order::where('status', 3)->orWhere('status', 4)->get());
        return $nb_order;
    }

    public function page_orders_admin()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin.orders_admin', compact('orders'));
    }

    public function page_order_view_admin($order_id)
    {
        $deliveries_order = Delivery::where('order_id', $order_id)->get();
        $order = Order::where('id', $order_id)->first();

        /* On calcule le temps du minuteur en jours, heures, minutes, secondes*/
        $date_created_at = $order->created_at;
        $nb_days = $order->nb_days;
        $minuteur_result = DateChangeController::date_minuteur($date_created_at, $nb_days);

        return view('admin.order_view_admin', compact('order', 'deliveries_order', 'minuteur_result'));
    }

    public function download_music_file_admin($message_id, $user_id)
    {

        $message = Message::where('id', $message_id)->where('user_id', $user_id)->first();

        if (!$message) {
            return view('page_error');
        } else {
            return Storage::download('public/music_conversations/' . $user_id . '/' . $message->content);
        }
    }

    public function download_delivery_file($delivery_id)
    {
        $user_id = auth()->user()->id;
        $delivery_file = Delivery::where('user_id', $user_id)->where('id', $delivery_id)->first();

        if (!$delivery_file) {
            return view('page_error');
        } else {
            return Storage::download('public/deliveries/' . $user_id . '/' . $delivery_file->file_delivery);
        }
    }
}
