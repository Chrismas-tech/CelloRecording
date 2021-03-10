<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileServeAdmin extends Controller
{
    public function __contrust()
    {
        $this->middleware('admin');
    }

    public function download_music_file_admin($message_id, $user_id, $message_type)
    {

        $message = Message::where('id', $message_id)->where('user_id', $user_id)->where('type', $message_type)->first();

        if (!$message) {
            return view('page_error');
        } else {

            return Storage::download('private/music_conversations/' . $user_id . '/' . $message->content);
        }
    }

    public function audio_delivery_admin($user_id, $delivery_id)
    {
        $audio_delivery = Delivery::where('user_id', $user_id)->where('id', $delivery_id)->first();

        $storage_path = storage_path('app/private/deliveries/' . $user_id . '/' . $audio_delivery->file_delivery);

        /* Est-ce que le fichier existe ? */
        if (file_exists($storage_path)) {
            
            return response()->file($storage_path);
        } else {
            /* Sinon page d'erreur */
            return view('page_error');
        }
    }

    public function download_delivery_file_admin($user_id, $delivery_id)
    {
        $delivery_file = Delivery::where('user_id', $user_id)->where('id', $delivery_id)->first();

        if (!$delivery_file) {
            return view('page_error');
        } else {
            return Storage::download('private/deliveries/' . $user_id . '/' . $delivery_file->file_delivery);
        }
    }
}
