<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Mail\MessageToAdmin;
use App\Models\Admin;
use App\Models\Conversation;
use App\Models\Delivery;
use App\Models\Message;
use App\Models\Notification;
use App\Models\NumberFiles;
use App\Models\Order;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth',['except' => 'page_contact']);
    }

    public function page_dashboard()
    {
        return view('dashboard');
    }

    public function page_quotes()
    {
        return view('quotes');
    }

    public function page_conversation()
    {

        /* Lors de l'ouverture de la conversation, on fait disparaître le nb de notifications de la relation USER -> ADMIN */

        $user = Auth::User();

        $notifications_exist = Notification::where('to', $user->name)->first();
        $notifications_exist->nb_notif = 0;
        $notifications_exist->save();


        /**********************************************/
        /**********************************************/
        /**********************************************/
        /**********************************************/


        $user_id = $user->id;
        $admin = Admin::find(1);

        $messages = Message::where('user_id', "=", $user_id)->get();
        return view('conversation', compact('messages', 'user', 'admin'));
    }

    public function page_profile()
    {
        return view('profile');
    }

    public function new_conversation(Request $request)
    {

        $request->validate([
            'message' => 'required',
        ]);

        /* VARIABLES */

        /*Création du nouveau message*/

        $user_id = Auth::user()->id;
        $admin_id = Admin::find(1)->id;

        $from =  auth()->user()->name;
        $to = Admin::find(1)->name;

        $message = $request->message;

        $datas_messages = [
            'content' => $message,
            'user_id' => $user_id,
            'from' => $from,
            'to' => $to,
            'admin_id' => $admin_id,
            'type' => 'message',
        ];

        Message::create($datas_messages);

        /*
        On créé 2 nouvelles lignes dans la table notifications :
        Elles vont gérer les notifications dans le sens User -> Admin et Admin -> User 
        */

        $notifications = Notification::where('from', $from)->first();
        $notifications->nb_notif += 1;
        $notifications->save();

        $email_user = User::find($user_id)->email;
        $user_name = User::find($user_id)->name;
        $url_redirection = 'http://cellorecording.ml/conversation_with_user/'.$user_id;

        /*On envoie un mail à l'admin*/
        
        Mail::to('electriccellofou@gmail.com')->send(new MessageToAdmin($email_user, $user_name, $notifications->nb_notif,$url_redirection));


        return redirect()->back();
    }

    public static function notifications()
    {
        $user_name = Auth::User()->name;
        $nb_notifications = Notification::where('to', $user_name)->sum('nb_notif');

        return $nb_notifications;
    }


    public static function quotes_notifications()
    {
        $user_id = Auth::User()->id;
        $nb_quote = count(Quote::where('user_id', $user_id)->get());

        return $nb_quote;
    }

    public static function order_notifications()
    {
        $user_id = Auth::User()->id;
        $nb_order = count(Order::where('user_id', $user_id)
            ->whereIn('status', [1, 2, 3, 4])->get());

        return $nb_order;
    }

    public function page_orders()
    {
        $user_id = Auth()->user()->id;
        $orders = Order::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();

        return view('orders', compact('user_id', 'orders'));
    }

    public function page_order_view($order_id)
    {
        $user_id = Auth()->user()->id;
        $order = Order::where('id', $order_id)->first();
        return view('order_view', compact('user_id', 'order'));
    }

    public function page_quotes_received()
    {
        $user_id = Auth()->user()->id;
        $quotes = Quote::where('user_id', $user_id)->get();

        return view('quotes_received', compact('user_id', 'quotes'));
    }

    public function quotes_decline($quote_id)
    {
        $user_id = auth()->user()->id;
        $quote = Quote::where('user_id', $user_id)->where('id', $quote_id)->first();

        if (!$quote) {

            return view('page_error');
        } else {


            /* On supprime l'offre en cours */
            Quote::destroy($quote_id);

            /* Envoyer un message automatique dans la conversation pour prévenir l'Admin*/

            $user_id = Auth::user()->id;
            $admin_id = Admin::find(1)->id;

            $from = auth()->user()->name;
            $to = Admin::find(1)->name;
            $message_declined = 'This is an automatic message, the client has declined your last offer';

            $datas_messages = [
                'content' => $message_declined,
                'user_id' => $user_id,
                'from' => $from,
                'to' => $to,
                'admin_id' => $admin_id,
                'type' => 'automatic_message',
            ];

            /* On créé un message, et on incrémente une notification de message */
            Message::create($datas_messages);

            $notifications = Notification::where('from', $from)->first();
            $notifications->nb_notif += 1;
            $notifications->save();


            return redirect()->back()->with('message', 'You have successfully declined the custom offer ! An automatic message has been sent to inform Christophe Luciani');
        }
    }

    public static function deliveries_notifications()
    {
        $user_id = Auth::User()->id;
        $nb_deliveries = count(Delivery::select('order_id')->where('user_id', $user_id)->distinct()->get());
        return $nb_deliveries;
    }

    public function page_deliveries()
    {

        $user_id = Auth()->user()->id;
        $user_name = Auth()->user()->name;

        $orders_completed = Order::where('user_id', $user_id)->whereIn('status', [1, 5])->get();

        $deliveries = Delivery::all()->where('user_id', $user_id);
        $nb_deliveries = count($deliveries);


        return view('deliveries', compact('user_id', 'deliveries', 'nb_deliveries', 'user_name', 'orders_completed'));
    }

    public function page_delivery_view(Request $request, $order_id)
    {

        $user_id = Auth()->user()->id;
        $user_name = Auth()->user()->name;

        $order = Order::where('id', $order_id)->where('user_id', $user_id)->first();

        if (!$order) {

            return view('page_error');
        } else {

            /*Créations de Variables de Session pour vérifier le retour des futurs boutons Radios*/

            $order_datas_session = ['id' => $order->id, 'status' => $order->status, 'nb_revision' => $order->nb_revision];

            if (($request->session()->has('order_datas_session'))) {

                $request->session()->forget('order_datas_session');
                $request->session()->push('order_datas_session', $order_datas_session);
            } else {
                $request->session()->push('order_datas_session', $order_datas_session);
            }

            /*Deliveries of order N° $order_id*/

            $deliveries = Delivery::all()->where('user_id', $user_id)->where('order_id', $order_id);

            return view('delivery_view', compact('user_id', 'deliveries', 'order'));
        }
    }

    public function update_delivery(Request $request)
    {

        $order_session = $request->session()->get('order_datas_session');

        $user_id = auth()->user()->id;
        $order = Order::where('user_id', $user_id)->where('id', $order_session[0]['id'])->first();

        if (($order->status == 1) && ($order->nb_revision == 1)) {

            if ($request->order_status == 4) {
                $order->status = 4;
                $order->nb_revision -= 1;
                $order->save();
                $request->session()->forget('order_datas_session');
                return redirect('orders');
            } elseif ($request->order_status == 5) {
                $order->status = 5;
                $order->save();
                $request->session()->forget('order_datas_session');
                return redirect('orders');
            } else {
                $request->session()->forget('order_datas_session');
                return view('page_error');
            }
        } elseif (($order->status == 1) && ($order->nb_revision == 0)) {

            if ($request->order_status == 5) {
                $order->status = 5;
                $order->save();

                /*On supprime les fichiers musicaux de la conversation et ses messages*/
                Storage::deleteDirectory('public/music_conversations/' . $user_id);

                /*Supprimer le reste*/
                Message::where('user_id', $user_id)->delete();
                $number_files_conversation = NumberFiles::where('user_id', $user_id)->first();
                $number_files_conversation->nb_download_files = 0;
                $number_files_conversation->save();
                $request->session()->forget('order_datas_session');
                return redirect('orders');
            } else {
                $request->session()->forget('order_datas_session');
                return view('page_error');
            }
        }
    }


    public function update_profile(Request $request)
    {

        /*Si on change de nom d'utilisateur, le nom doit être changé sur les tables Notifications et Messages sinon cela créé des erreurs*/

        $old_user_name = $request->old_user_name;

        $messages_user = Message::where('user_id', auth()->user()->id)->get();
        $notifications_user = Notification::where('user_id', auth()->user()->id)->get();

        foreach ($messages_user as $message) {

            if ($message->from == $old_user_name) {
                $message->from = $request->name;
                $message->save();
            } elseif ($message->to == $old_user_name) {
                $message->to = $request->name;
                $message->save();
            }
        }

        foreach ($notifications_user as $notification) {

            if ($notification->from == $old_user_name) {
                $notification->from = $request->name;
                $notification->save();
            } elseif ($notification->to == $old_user_name) {
                $notification->to = $request->name;
                $notification->save();
            }
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        User::find(auth()->user()->id)->update(
            [
                'name' => $request->name,
                'email' => $request->email,
            ]
        );

        /*Update Name sur les messages et notifications*/



        return redirect('profile')->with('success_update', 'Username and email has been successfully updated !');;
    }

    public function delete_account()
    {
        $user_id = auth()->user()->id;

        /*On suppime tout !*/

        /*Supprimer les fichiers musicaux et images de profil*/
        Storage::deleteDirectory('public/music_conversations/' . $user_id);
        Storage::deleteDirectory('public/deliveries/' . $user_id);
        Storage::deleteDirectory('public/images/' . $user_id);

        /*Supprimer le reste*/
        Delivery::where('user_id', $user_id)->delete();
        Message::where('user_id', $user_id)->delete();
        Order::where('user_id', $user_id)->delete();
        Quote::where('user_id', $user_id)->delete();
        NumberFiles::where('user_id', $user_id)->delete();
        Notification::where('user_id', $user_id)->delete();
        User::destroy($user_id);


        return redirect('/');
    }

    public function page_contact()
    {
        return view('contact');
    }

    public function page_send_contact_email(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        $message = $request->message;
        $name = $request->name;
        $email = $request->email;

        Mail::to('electriccellofou@gmail.com')->send(new ContactMail($message, $name, $email));

        return redirect('contact')->with('send_success', 'Your email has been successfully sent !');
    }

    public function download_music_file_user($message_id)
    {
        $user_id = auth()->user()->id;
        $message = Message::where('user_id', $user_id)->where('id', $message_id)->first();

        if (!$message) {
            return view('page_error');
        } else {
            return Storage::download('public/music_conversations/' . $user_id . '/' . $message->content);
        }
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
}
