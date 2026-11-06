<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;

class PaketController extends Controller {
    public function index() {
        $paket = Paket::orderBy('price', 'asc')
        ->orderBy('id', 'asc')
        ->paginate(10);

        return view('admin.paket.index', compact('paket'));
    }

    public function create() {
        return view('admin.paket.create');
    }

    public function store(Request $request) {
        
    $validated = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'facilities' => 'nullable|string',
        ]);

        Paket::create($validated);

        return redirect()
            ->route('admin.paket.index')
            ->with('success', 'Paket berhasil ditambahkan.');
    }

    public function show(string $id) {
        //
    }

    public function edit(string $id) {
        $paket = Paket::findOrFail($id);

        return view('admin.paket.edit', compact('paket'));
    }

    public function update(Request $request, string $id) {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'facilities' => 'nullable|string',
        ]);

        $paket = Paket::findOrFail($id);
        $paket->update($validated);

        return redirect()
            ->route('admin.paket.index')
            ->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy(string $id) {
        $paket = Paket::findOrFail($id);
        $paket->delete();

        return redirect()
            ->route('admin.paket.index')
            ->with('success', 'Paket berhasil dihapus.');
    }
}