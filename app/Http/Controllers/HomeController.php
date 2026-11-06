<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Testimoni;
use App\Models\Galeri;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pakets = Paket::orderBy('harga', 'asc')->get();

        $testimonis = Testimoni::all();

        $galeris = Galeri::all();

        return view('landing.index', compact(
            'pakets',
            'testimonis',
            'galeris'
        ));
    }
}