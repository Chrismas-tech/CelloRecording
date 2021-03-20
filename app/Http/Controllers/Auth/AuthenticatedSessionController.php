<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Artesaos\SEOTools\Facades\SEOMeta;
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

        SEOMeta::setCanonical('https://cellorecording.test/' . $name_route);
        SEOMeta::addKeyword([
            'cello recording studio',
            'cello recording online',
            'cello recording app',
            'cello recordings best',
            'cello recording techniques',
            'recording cello at home',
            'cello audio recording',
            'cello recording studios los angeles',
            'recording a cello',
            'best cello recording',
            'recording for cello',
            'cello home recording',
            'cello in recording ',
            'remote cello recording',
            'recording cello solo',
            'recording setup cello',
            'how to record cello at home',
            'how to recording cello sound',
            'cello customer service',
            'cello wrapping services',
            'cello customer service number',
            'cello customer care',
            'cello tv customer service',
            'cello connection',
            '2 cello',
            '2cellos',
            'recording cello',
            'cello session player',
            'remote cello recording online',
        ]);

        switch ($name_route) {
            case $name_route == 'login':
                SEOMeta::setTitle('Professional Cello Recording Services Online | 7/7 days');
                SEOMeta::setDescription('Login into your account on Cellorecording.com, fill the following formular');
                break;
        }
    }
}
