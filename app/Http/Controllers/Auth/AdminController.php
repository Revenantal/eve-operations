<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        //  Can  be build out  to display  op details  and/or results
        return view('admin.dashboard');
    }
}
