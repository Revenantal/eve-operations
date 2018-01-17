<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use nullx27\Easi\Easi;
use User\Auth;
use App\Operation;



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
        //
    }
}
