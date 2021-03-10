<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileImageServe extends Controller
{
    public function __contrust()
    {
        $this->middleware('auth');
    }

    public function profile_image_serve($id)
    {
        $path = storage_path('app/private/images/' . $id . '/' . Auth::user()->avatar);
        if (file_exists($path)) {
            return response()->file($path);
        } else {
            abort('404');
        }
    }

    public function download_demo_cello() {

        $demo_path = storage_path('app/private/demo/Cello_demo.mp3');

        if (file_exists($demo_path)) {
            return Storage::download('private/demo/Cello_demo.mp3');
        }

    }
    
}
