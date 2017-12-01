<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use nullx27\Easi\Easi;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user_id = auth()->user()->id;
        //https://nullx27.github.io/easi/class-nullx27.Easi.Api.Endpoints.Character.html
        $easi = new Easi();
        $apiCharacter = $easi->character->getProtrait($user_id);
        return("<img src='{$apiCharacter->data['px512x512']}' />");
    }
}