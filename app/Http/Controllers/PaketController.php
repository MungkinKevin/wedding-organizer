<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Paket;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paket = Paket::latest()->paginate(10);

        return view('admin.paket.index', compact('paket'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.paket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'facility1' => 'nullable|string|max:255',
            'facility2' => 'nullable|string|max:255',
            'facility3' => 'nullable|string|max:255',
            'facility4' => 'nullable|string|max:255',
            'facility5' => 'nullable|string|max:255',
            'facility6' => 'nullable|string|max:255',
        ]);

        Paket::create($validated);

        return redirect()
            ->route('admin.paket.index')
            ->with('success', 'Paket berhasil ditambahkan.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $paket = Paket::findOrFail($id);
        
        return view('admin.paket.edit', compact('paket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'facility1' => 'nullable|string|max:255',
            'facility2' => 'nullable|string|max:255',
            'facility3' => 'nullable|string|max:255',
            'facility4' => 'nullable|string|max:255',
            'facility5' => 'nullable|string|max:255',
            'facility6' => 'nullable|string|max:255',
        ]);

        $paket = Paket::findOrFail($id);
        $paket->update($validated);

        return redirect()
            ->route('admin.paket.index')
            ->with('success', 'Paket berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paket = Paket::findOrFail($id);
        $paket->delete();

        return redirect()
            ->route('admin.paket.index')
            ->with('success', 'Paket berhasil dihapus.');
    }
}
