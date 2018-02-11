<?php

namespace App\Http\Controllers\EVE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EVE\SolarSystem;

class SolarSystemsController extends Controller
{
    public function search($name)
    {
        $data = SolarSystem::where('name', 'like', $name.'%')->get();
        return response()->json($data);
    }
}