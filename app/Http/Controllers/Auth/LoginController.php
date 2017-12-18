<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Two\InvalidStateException;
use Socialite;


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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('eveonline')->redirect();
    }


    public function handleProviderCallback()
    {
        try {
            $sso_user = Socialite::driver('eveonline')->user();;
        } catch (InvalidStateException $exception) {
            Log::error($exception->getMessage());

            throw new \Exception("Could not retrieve user data!");
        }
        $user = User::find($sso_user->id);

        if (!$user) {
            User::create([
                'id' => $sso_user->id,
                'eve_token' => $sso_user->token,
                'username' => $sso_user->name,
                'avatar' => $sso_user->avatar
            ]);
        }

        Auth::loginUsingId($sso_user->id, true);
        return redirect('/')->with('success', 'Login successful!');
    }   
}
