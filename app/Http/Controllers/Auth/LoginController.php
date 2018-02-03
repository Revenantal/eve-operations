<?php

namespace App\Http\Controllers\Auth;

use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Models\Auth\Whitelist;
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
        $corporation = $api->corporations($character->corporation_id)->get();

        // Collect Alliance id
        $caid = data_get($character, 'data.alliance_id');

        // Check if corp or alliance is whitelisted
        if ($caid) {
            $access = Whitelist::where('alliance_id', '=', $character->alliance_id)->count() > 0;
        } else {
            $access = Whitelist::where('corporation_id', '=', $character->corporation_id)->count() > 0;
        }

        if(!$access) {
            return abort(403, 'Your Corporation or Alliance is not whitelisted!');
        }

        // Check if user exists
        $user = User::firstOrNew(['character_id' => $ssoUser->id]);

        // And then update the data in case something changed
        $user->character_id = $ssoUser->id;
        $user->character_name = $character->name;
        $user->corporation_id = $character->corporation_id;
        $user->corporation_name = $corporation->name;
        if ($caid) {
            $alliance = $api->alliances($caid)->get();
            $user->alliance_id = $character->alliance_id;
            $user->alliance_name = $alliance->name;
        } else  {
            $user->alliance_id = 0;
            $user->alliance_name = 'No Alliance';
        }

        $user->last_login = Carbon::now();
        $user->save();

        $user->attachRole(Role::where('name', 'User')->first());

        // and then log in
        Auth::login($user, true);

        Toastr::success("Login Successful!");

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}