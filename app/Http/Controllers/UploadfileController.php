<?php

namespace App\Http\Controllers;

use App\Mail\Delivery as MailDelivery;
use App\Models\Message;
use App\Models\Delivery;
use App\Models\Notification;
use App\Models\NumberFiles;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class UploadfileController extends Controller
{

    public function uploadphoto(Request $request)
    {

        if ($request->hasFile('file')) {

            /* On supprime la photo précédente si elle existe*/

            $avatar_old = auth()->user()->avatar;
            $user_id = auth()->user()->id;

            if ($avatar_old) {
                Storage::delete('public/images/' . $user_id . '/' . $avatar_old);
            }

            /*On  vérifie l'extension du fichier et on l'enregistre s'il est conforme dans Storage/images du dossier public  */

            $extension_file = $request->file('file')->extension();
            $size_file = $request->file('file')->getSize();

            if ($extension_file == 'png' || $extension_file == 'jpg' && $size_file < 2097152) {

                $filename = $request->file->getClientOriginalName();
                $request->file->storeAs('images/' . $user_id . '/', $filename, 'public');
                auth()->user()->update(['avatar' => $filename]);

                $success = "File has been successfully uploaded !";
                return $success;
            }
        } else {

            $error = "Incorrect file type or size !";
            return $error;
        }
    }

    public function upload_music_user(Request $request)
    {

        if ($request->hasFile('file')) {

            $files = $request->file('file');

            foreach ($files as $file) {

                /* VERIFICATION DE L'EXTENSION DES FICHIERS */
                $extension_file = $file->extension();

                // $size_file = $request->file('file')->getSize();

                if ($extension_file == "mp3" || $extension_file == "wav") {

                    $user_id = Auth()->user()->id;
                    $user_name = Auth()->user()->name;

                    /*On incrémente de 1 le nombre de download_files*/
                    $nb_download_files_user = $this->increment_download_files_user();

                    $name_file = $file->getClientOriginalName();
                    $file_name = 'Download-File n°' . $nb_download_files_user->nb_download_files  . ' - ' .  $name_file;
                    $file->storeAs('music_conversations/' . $user_id, $file_name, 'public');

                    /* CREATION D'UN NOUVEAU MESSAGE AVEC LE NOM DU FICHIER EN TANT QUE CONTENT */

                    $datas = [
                        'content' => $file_name,
                        'from' => $user_name,
                        'to' => 'Christophe Luciani',
                        'user_id' => $user_id,
                        'admin_id' => 1,
                        'type' => 'download_file'
                    ];

                    Message::create($datas);

                    /*On actualise une notif relation Admin -> User */

                    $notifications = Notification::where('from', $user_name)->first();
                    $notifications->nb_notif += 1;
                    $notifications->save();
                } else {
                    /* SI L'EXTENSION DE L'UN DES FICHIER N'EST PAS VALIDE -> MESSAGE D'ERREUR */
                    return "Incorrect files type or size ! Wav or Mp3 files accepted !";
                }
            }
            /* TOUS LES FICHIERS ONT ETE UPLOADE ET VERIFIE -> MESSAGE DE SUCCES*/
            return "Files have been successfully uploaded !";
        } else {
              /* IL N'Y A PAS DE FICHIER A l'UPLOAD -> MESSAGE D'ERREUR */
            return "Choose files to upload !";
        }
    }


    public function upload_music_admin(Request $request, $user_id)
    {

        if ($request->hasFile('file')) {

            $files = $request->file('file');

            foreach ($files as $file) {

                $extension_file = $file->extension();
                //   $size_file = $request->file('file')->getSize();

                if ($extension_file == "mp3" || $extension_file == "wav") {

                    $user = User::where('id', $user_id)->first();
                    $to = $user->name;


                    $nb_download_files_admin = $this->increment_download_files_admin($user_id);

                    $name_file = $file->getClientOriginalName();

                    $file_name = 'Download-File n°' . $nb_download_files_admin->nb_download_files . ' - ' .  $name_file;

                    $file->storeAs('music_conversations/' . $user_id, $file_name, 'public');

                    /*
                        Création d'un nouveau message avec le nom du fichier en tant que content
                        */

                    $datas = [
                        'content' => $file_name,
                        'from' => 'Christophe Luciani',
                        'to' => $to,
                        'user_id' => $user_id,
                        'admin_id' => 1,
                        'type' => 'download_file'
                    ];

                    Message::create($datas);

                    /*On actualise une notif relation Admin -> User */

                    $notifications = Notification::where('from', '=', 'Christophe Luciani')
                        ->where('to', $to)->first();

                    $notifications->nb_notif += 1;
                    $notifications->save();
                } else {
                    return "Incorrect files type or size ! Wav or Mp3 files accepted !";
                }
            }
            return "Files have been successfully uploaded !";
        } else {
            return 'Choose files to upload !';
        }
    }


    public function upload_delivery(Request $request)
    {

        if ($request->hasFile('file')) {

            $files = $request->file('file');

            foreach ($files as $file) {

                $extension_file = $file->extension();

                if ($extension_file == "mp3" || $extension_file == "wav") {

                    $order_id = $request->get('order_id');
                    $user_id = $request->get('user_id');

                    /*On incrémente de 1 le nombre de delivery_files*/
                    $nb_delivery_files = $this->increment_delivery_files($user_id);

                    $name_file = $file->getClientOriginalName();
                    $file_name = 'Delivery-File n°' . $nb_delivery_files->nb_delivery_files . ' - ' .  $name_file;

                    $file->storeAs('deliveries/' . $user_id . '/', $file_name, 'public');

                    /*Création d'une nouvelle delivery */

                    $datas = [
                        'order_id' => $order_id,
                        'user_id' => $user_id,
                        'file_delivery' => $file_name,
                    ];

                    Delivery::create($datas);

                    /*on modifie le statut de la commande*/
                    $order = Order::where('id', $order_id)->first();
                    $order->status = 1;
                    $order->save();
                } else {
                    return "Incorrect files type or size !";
                }
            }

            /*On envoie un mail à l'utilisateur*/

            $user = User::find($user_id);
            $order_id = $order->id;
            $email_user = $user->email;
            $user_name = $user->name;

            Mail::to($email_user)->send(new MailDelivery($user_name, $order_id));

            return "Files have been successfully uploaded !";
        } else {

            return 'Choose files to upload !';
        }
    }

    /*PRIVATE FUNCTIONS INCREMENT DOWNLOAD FILES*/
    /*PRIVATE FUNCTIONS INCREMENT DOWNLOAD FILES*/
    /*PRIVATE FUNCTIONS INCREMENT DOWNLOAD FILES*/
    /*PRIVATE FUNCTIONS INCREMENT DOWNLOAD FILES*/
    /*PRIVATE FUNCTIONS INCREMENT DOWNLOAD FILES*/

    private function increment_download_files_user()
    {
        $nb_download_files_user = NumberFiles::where('user_id', auth()->user()->id)->first();
        $nb_download_files_user->nb_download_files += 1;
        $nb_download_files_user->save();

        return $nb_download_files_user;
    }

    private function increment_download_files_admin($user_id)
    {
        $nb_download_files_admin = NumberFiles::where('user_id', $user_id)->first();
        $nb_download_files_admin->nb_download_files += 1;
        $nb_download_files_admin->save();

        return $nb_download_files_admin;
    }

    private function increment_delivery_files($user_id)
    {
        $nb_delivery_files = NumberFiles::where('user_id', $user_id)->first();
        $nb_delivery_files->nb_delivery_files += 1;
        $nb_delivery_files->save();

        return $nb_delivery_files;
    }
}
