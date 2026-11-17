<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class AdminTestimoniController extends Controller
{
    public function index() {
        $testimoni = Testimoni::latest()->paginate(10);

        return view('admin.testimoni.index', compact('testimoni'));
    }

    public function create() {
        return view('admin.testimoni.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'client_name' => 'required|string|max:30',
            'content' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        Testimoni::create($validated);

        return redirect()
            ->route('admin.testimoni.index')
            ->with('success', 'Testimoni Berhasil ditambahkan.');
    }

    public function edit(string $id) {
        $testimoni = Testimoni::findOrFail($id);

        return view('admin.testimoni.edit', compact('testimoni'));
    }

    public function update(Request $request, string $id) {
        $validated = $request->validate([
            'client_name' => 'required|string|max:30',
            'content' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $testimoni = Testimoni::findOrFail($id);
        $testimoni->update($validated);

        return redirect()
            ->route('admin.testimoni.index')
            ->with('success','Testimoni berhasil diperbarui.');
    }

    public function destroy(string $id) {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->delete();

        return redirect()
            ->route('admin.testimoni.index')
            ->with('success','Testimoni Berhasil Dihapus.');
    }
}
