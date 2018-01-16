<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use User\Auth;
use App\Operation;
use Toastr;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$user_id = auth()->user()->id;

        //$easi = new Easi();
        //$apiCharacter = $easi->character->getProtrait($user_id);
        //return view('home')->with('data', $apiCharacter);
        $operations = Operation::orderBy('operation_at', 'asc')->get();
        return view('home')->with('operations', $operations);
    }
}
