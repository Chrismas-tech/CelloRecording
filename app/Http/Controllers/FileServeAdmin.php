<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileServeAdmin extends Controller
{
    public function __contrust()
    {
        $this->middleware('admin');
    }

    public function audio_delivery_admin($user_id, $file_name)
    {
        $storage_path = storage_path('app/private/deliveries/'.$user_id.'/'.$file_name);
       return response()->file($storage_path);
    }
}
