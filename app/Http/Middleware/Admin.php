<?php

namespace App\Http\Middleware;

use App\Models\Admin as ModelsAdmin;
use Closure;
use Illuminate\Http\Request;

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

        /* Si les variables Session existent déjà on renvoie vers la page suivante */

        if ($request->session()->get('admin_name') && $request->session()->get('admin_password')) {

            return $next($request);
        } else {

            /* Si on se trouve sur la page Admin-Connexion */
            /* On vérifie les inputs, on les compare avec la BDD, si ils sont correct on créé 2 variables de session */

            if ($request->name && $request->password) {

                $request->validate([
                    'name' => 'required',
                    'password' => 'required'
                ]);

                $name_input = $request->name;
                $password_input = $request->password;

                $admin = ModelsAdmin::where('id', 1)->first();

                $admin_name = $admin->name;
                $admin_password = $admin->password;

                /* Si le mot de passe et le nom sont correct -> dashboard_admin */
                if ($name_input == $admin_name && $password_input == $admin_password) {

                    $request->session()->push('admin_name', $admin_name);
                    $request->session()->push('admin_password', $admin_password);

                    return redirect('dashboard_admin');
                } else {
                    /* Sinon rafraîchissement et message d'erreur */
                    return redirect()->back()->with('error', 'Invalid name or password');
                }
            }
        }
        /* Sinon on ne donne pas l'accès */
        return redirect('not_authorized');
    }
}
