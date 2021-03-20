<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $name_route = Route::getFacadeRoot()->current()->uri();
        $this->metaTag($name_route);
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect('/');
    }

    private function metaTag($name_route)
    {

        SEOTools::setCanonical('https://cellorecording.test/' . $name_route);
        SEOTools::addKeyword([
            'cellorecording.com',
            'Cello recording',
            'Login into your account',
        ]);

        switch ($name_route) {
            case $name_route == 'login':
                SEOTools::setTitle('Login into your account');
                SEOTools::setDescription('Login into your account on Cellorecording.com, fill the following formular');
                break;
        }
    }
}
