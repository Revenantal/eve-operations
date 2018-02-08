<?php

namespace App\Http\Controllers;

use App\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Toastr;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        if(Auth::check()){
            $operations = Operation::orderBy('operation_at', 'asc')->get();
            return view('home')->with('operations', $operations);
        } else {
            return redirect('auth/login');
        }
    }
}