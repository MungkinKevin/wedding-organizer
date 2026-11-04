<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Testimoni;
use App\Models\Galeri;

class LandingController extends Controller
{
    public function index()
    {
        // Mengambil data paket berdasarkan harga termurah
        $pakets = Paket::orderBy('price', 'asc')->get();

        // Mengambil seluruh data testimoni
        $testimonis = Testimoni::all();

        // Mengambil seluruh data galeri
        $galeris = Galeri::all();

        return view('landing.index', compact(
            'pakets',
            'testimonis',
            'galeris'
        ));
    }
}
