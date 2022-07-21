<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }
    public function redirectToGithubCallback()
    {
        $user = Socialite::driver('github')->user();
        $this->_registerOrLogin($user);
        return redirect()->route('home');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function redirectToFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $this->_registerOrLogin($user);
        return redirect()->route('home');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function redirectToGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $this->_registerOrLogin($user);
        return redirect()->route('home');
    }


    protected function _registerOrLogin($data)
    {

        $user = User::where('email', '=', $data->email)->first();
        if (!$user) {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->provider_id;
            $user->avatar = $data->avatar;
            $user->save();
        }
        Auth::login($user);
    }
}
