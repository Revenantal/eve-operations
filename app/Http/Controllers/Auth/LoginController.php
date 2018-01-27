<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Conduit\Conduit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Two\InvalidStateException;
use PHPUnit\Exception;
use Socialite;
use Toastr;

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

    /**
     * Login using the eve online socialite driver
     *
     * @return Exception
     */
    public function login()
    {
        try {
            return Socialite::driver('eveonline')
                ->redirect();
        } catch (\Exception $e) {
            Log::error('Redirect to EvE Online SSO failed');
            return abort(502);
        }
    }

    public function callback()
    {
        try {
            $ssoUser = Socialite::driver('eveonline')->user();
        } catch (InvalidStateException $e) {
            return redirect()->route('login');
        }

        // Collect character data
        $api = new Conduit();
        $character =  $api->characters($ssoUser->id)->get();

        // Check if user exists
        $user = User::firstOrNew(['character_id' => $ssoUser->id]);

        // And then update the data in case something changed
        $user->character_id = $ssoUser->id;
        $user->character_name = $character->name;
        $user->corporation_id = $character->corporation_id;

        if ($character->alliance_id) {
            $user->alliance_id = $character->alliance_id;
        } else {
            $user->alliance_id = 0;
        }

        $user->last_login = Carbon::now();
        $user->save();

        // and then log in
        Auth::login($user, true);

        return redirect('/');

        Toastr::success("Login Successful!");
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}