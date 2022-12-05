<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
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


        // return $request->ip();

        $request->authenticate();

        $request->session()->regenerate();

        // $auth_user = Auth::user();
        $user_ip = Location::where('user_id', Auth::user()->id)->first();

        if (!$user_ip->user_ip === $request->ip) {

            Location::create([
                'user_id' => Auth::user()->id,
                'user_ip' => $request->ip(),
                'login_at' => now(),
            ]);

            $info = array(
                'ip' => $request->ip(),
                'email' => Auth::user()->email,
            );

            Mail::send('access', $info, function ($message) use ($info) {
                $message->from('developerfaisal32@gmail.com', 'Faisal Ahmmed');
                $message->to($info['email']);
                $message->subject('New Access form this ip ');
            });


        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
