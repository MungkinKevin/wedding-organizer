<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPaket = Paket::count();

        return view('admin.dashboard', compact('totalPaket'));
    }
}
