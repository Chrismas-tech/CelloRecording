<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SEOController;
use App\Models\Admin as ModelsAdmin;
use App\Models\Notification;
use App\Models\NumberFiles;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $name_route = Route::currentRouteName();
        //dd($name_route);
        SEOController::metaTag($name_route);

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        Auth::login($user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]));

        event(new Registered($user));

        /*
        On créé 2 nouvelles lignes dans la table notifications :
        Elles vont gérer les notifications dans le sens User -> Admin et Admin -> User 
        */

        $user_id = Auth()->user()->id;
        $admin_id = ModelsAdmin::find(1)->id;

        $notifs_user_to_admin = [
            'user_id' => $user_id,
            'admin_id' => $admin_id,
            'direction_send' => 0,
            'nb_notif' => 0,
        ];

        $notifs_admin_to_user = [
            'user_id' => $user_id,
            'admin_id' => $admin_id,
            'direction_send' => 1,
            'nb_notif' => 0,
        ];

        $datas = [
            'user_id' => $user_id,
        ];

        Notification::create($notifs_user_to_admin);
        Notification::create($notifs_admin_to_user);

        NumberFiles::create($datas);

        return redirect(RouteServiceProvider::HOME);
    }
}
