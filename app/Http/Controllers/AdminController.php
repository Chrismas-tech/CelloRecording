<?php

namespace App\Http\Controllers;

use App\Mail\Messages;
use App\Mail\Quote as MailQuote;
use App\Models\Admin;
use App\Models\Delivery;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'page_admin']);
        
        $name_route = Route::currentRouteName();
        //dd($name_route);
        SEOController::metaTag($name_route);
    }

    public function connection_already_verified()
    {
        return redirect('dashboard-admin');
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

        /* Si les dossiers music_conversation et deliveries n'existent pas on les créé */
        $path = storage_path('app/private/music_conversations');

        if (!file_exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        $path = storage_path('app/private/deliveries');

        if (!file_exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        $path = storage_path('app/private/images');

        if (!file_exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        /* On calcule la taille des fichiers musicaux sur le serveur*/
        $datas_size_file = $this->get_size_of_music_files_on_server();

        /* Total de l'espace disk libre restant */
        $total_space_server = floor((disk_total_space("/")) / pow(10, 9));
        $free_space_server_remaining = floor((disk_free_space("/")) / pow(10, 9));


        $nb_users = count(User::all());
        $nb_orders_delivered = count(Order::where('status', '1')->get());
        $nb_orders_canceled = count(Order::where('status', '2')->get());
        $nb_orders_waiting = count(Order::where('status', '3')->get());
        $nb_orders_revision = count(Order::where('status', '4')->get());
        $nb_orders_completed = count(Order::where('status', '5')->get());

        $admin_name = Admin::find(1)->name;

        return view('admin.dashboard', compact('admin_name', 'nb_users', 'nb_orders_waiting', 'nb_orders_completed', 'nb_orders_revision', 'nb_orders_canceled', 'nb_orders_delivered', 'datas_size_file', 'total_space_server', 'free_space_server_remaining'));
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

    public function page_list_conversation_admin(Request $request)
    {

        $admin_id = Admin::find(1)->id;
        $notifs_all_user = Notification::where('direction_send', 0)->where('nb_notif', '!=', 0)->get();

        /* On compte le nombre d'utilisateur */

        $nb_users = User::all();
        $nb_notifications = Notification::where('admin_id',  $admin_id)->sum('nb_notif');

        return view('admin.list_conversation_admin', compact('nb_notifications', 'nb_users', 'notifs_all_user'));
    }

    public static function notifications()
    {
        $admin_id = Admin::find(1)->id;
        $nb_notifications = Notification::where('direction_send', 0)->where('admin_id', $admin_id)->sum('nb_notif');
        return $nb_notifications;
    }

    public function conversation_with_user($user_id)
    {

        /* Lors de l'ouverture de la conversation, on fait disparaître le nb de notifications de la relation ADMIN -> USER si la relation existe entre les deux */

        $notifications_exist = Notification::where('direction_send', 0)->where('user_id', $user_id)->first();

        if ($notifications_exist) {
            $notifications_exist->nb_notif = 0;
            $notifications_exist->save();
        }

        /**********************************************/
        /**********************************************/
        /**********************************************/
        /**********************************************/

        $messages = Message::where('user_id', $user_id)->get();
        //dd($messages);
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
        $message = $request->message;

        $datas_messages = [
            'content' => $message,
            'user_id' => $user_id,
            'admin_id' => $admin_id,
            'direction_send' => 1,
            'type' => 1,
        ];

        /*Création du nouveau message*/
        Message::create($datas_messages);

        /*On incrémente de 1 la relation Admin->User dans la table Notification*/
        $notifications = Notification::where('admin_id', $admin_id)->where('user_id', $user_id)->where('direction_send', 1)->first();

        $notifications->nb_notif += 1;
        $notifications->save();

        /*Pour le mail*/
        $email_user = User::find($user_id)->email;
        $admin_name = Admin::find(1)->name;
        $url_redirection = "https://www.cellorecording.com/conversation";

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

        $url_redirection = "https://www.cellorecording.com/quotes-received";

        /*On envoie un mail à l'utilisateur*/
        Mail::to($email_user)->send(new MailQuote($admin_name, $user_name, $datas, $url_redirection));

        return redirect('dashboard-admin')->with('quotesent', 'The quote has been successfully sent to the client !');
    }

    public static function quotes_notifications()
    {
        $nb_quote = count(Quote::all());
        return $nb_quote;
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

        /*
        $url = url('/private-storage/deliveries/1/Delivery-File n°1 - the-voice-of-poland-dorota-osinska-calling-you (mp3cut.net) (1).mp3');
        dd($url);

        if(file_exists($url)) {
         dd('yolo');
        }
       */

        /* On calcule le temps du minuteur en jours, heures, minutes, secondes*/
        $date_created_at = $order->created_at;
        $nb_days = $order->nb_days;
        $minuteur_result = DateChangeController::date_minuteur($date_created_at, $nb_days);

        return view('admin.order_view_admin', compact('order', 'deliveries_order', 'minuteur_result'));
    }

    private function get_size_of_music_files_on_server()
    {

        $path_music_conversation = storage_path('app/private/music_conversations');
        $path_music_deliveries = storage_path('app/private/deliveries');
        $path_images = storage_path('app/private/images');


        $file_size_music_conversations = 0;
        $file_size_deliveries = 0;
        $file_size_images = 0;

        foreach (File::allFiles($path_music_conversation) as $file) {
            $file_size_music_conversations += $file->getSize();
        }

        foreach (File::allFiles($path_music_deliveries) as $file) {
            $file_size_deliveries += $file->getSize();
        }

        foreach (File::allFiles($path_images) as $file) {
            $file_size_images += $file->getSize();
        }

        /* Pour avoir un résultat en mo en partant d'Octet (Byte), on divise par 104843 */

        $rapport_de_conversion_mo_to_bytes = 1048431;

        $file_mo_conversations = ceil($file_size_music_conversations / $rapport_de_conversion_mo_to_bytes);
        $file_mo_deliveries = ceil($file_size_deliveries / $rapport_de_conversion_mo_to_bytes);
        $file_mo_images = ceil($file_size_images / $rapport_de_conversion_mo_to_bytes);

        $total_size_mo = $file_mo_conversations + $file_mo_deliveries + $file_mo_images;
        $datas_size_file = [$file_mo_conversations, $file_mo_deliveries, $file_mo_images, $total_size_mo];

        return $datas_size_file;
    }
}
