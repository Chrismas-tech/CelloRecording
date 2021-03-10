<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileServeUser extends Controller
{
    public function __contrust()
    {
        $this->middleware('auth');
    }

    public function profile_image_serve($user_id)
    {
        /* Vérification que l'image affiché correspond à l'utilisateur connecté ! */
        if ($user_id == auth()->user()->id) {

            $path = storage_path('app/private/images/' . $user_id . '/' . Auth::user()->avatar);

            /* Est-ce que le fichier existe ? */
            if (file_exists($path)) {
                return response()->file($path);
            } else {
                /* Sinon page d'erreur */
                return view('page_error');
            }
        } else {
            /* Sinon page d'erreur */
            return view('page_error');
        }
    }

    public function download_demo_cello()
    {
        $demo_path = storage_path('app/private/demo/Cello_demo.mp3');

        if (file_exists($demo_path)) {
            return Storage::download($demo_path);
        }
    }

    public function audio_delivery_user($delivery_id)
    {
        $user_id = auth()->user()->id;
        $audio_delivery = Delivery::where('user_id', $user_id)->where('id', $delivery_id)->first();

        if (!$audio_delivery) {
            return view('page_error');
        } else {

            $storage_path = storage_path('app/private/deliveries/' . $user_id . '/' . $audio_delivery->file_delivery);

            /* Est-ce que le fichier existe ? */
            if (file_exists($storage_path)) {
                return response()->file($storage_path);
            } else {
                /* Sinon page d'erreur */
                return view('page_error');
            }
        }
    }

    public function download_music_file_user($message_id, $message_type)
    {
        $user_id = auth()->user()->id;
        $message = Message::where('user_id', $user_id)->where('id', $message_id)->where('type', $message_type)->first();

        if (!$message) {
            return view('page_error');
        } else {

            return Storage::download('private/music_conversations/' . $user_id . '/' . $message->content);
        }
    }

    public function download_delivery_file_user($delivery_id)
    {
        $user_id = auth()->user()->id;
        $delivery_file = Delivery::where('user_id', $user_id)->where('id', $delivery_id)->first();

        if (!$delivery_file) {
            return view('page_error');
        } else {

            return Storage::download('private/deliveries/' . $user_id . '/' . $delivery_file->file_delivery);
        }
    }
}
