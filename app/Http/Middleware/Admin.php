<?php

namespace App\Http\Middleware;

use App\Models\Admin as ModelsAdmin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /* LES VARIABLES DE SESSION EXISTENT -> PAGE SUIVANTE */
        if ($request->session()->has('admin_name') && $request->session()->has('admin_password')) {
            return $next($request);
        } else {

            /* SINON ON SE TROUVE SUR LA PAGE CONNECTION, $request->connexion existe */
            if ($request->connexion == 1) {

                /* ON VERIFIE LES INPUTS */
                $request->validate([
                    'name' => 'required',
                    'password' => 'required'
                ]);

                $name_input = $request->name;
                $password_input = $request->password;

                $admin = ModelsAdmin::where('id', 1)->first();

                $admin_name = $admin->name;
                $admin_password = $admin->password;

                /* SI LE PASSWORD ET LE NAME SONT CORRECTS -> Dashboard ADMIN */
                if ($name_input == $admin_name && (Hash::check($password_input,$admin_password) )) {

                    $request->session()->push('admin_name', $admin_name);
                    $request->session()->push('admin_password', $admin_password);

                    return redirect('dashboard-admin');
                } else {
                    /* SINON ERREUR SUR LA MEME PAGE */
                    return redirect()->back()->with('error', 'Invalid name or password');
                }
            } else {
                /* Sinon on ne donne pas l'accès */
                return redirect('not_authorized');
            }
        }
    }
}
