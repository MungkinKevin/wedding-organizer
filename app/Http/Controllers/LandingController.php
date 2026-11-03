<?php

namespace App\Http\Controllers;

use App\Models\Paket;

class LandingController extends Controller
{
    public function index()
    {
        $pakets = Paket::all();

        return view('landing.index', compact('pakets'));
    }
}
