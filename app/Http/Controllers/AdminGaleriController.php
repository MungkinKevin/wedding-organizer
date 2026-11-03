<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;

class AdminGaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::latest()->paginate(12);

        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:30',
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('photo')->store('galeri', 'public');

        Galeri::create([
            'title' => $validated['title'],
            'photo' => $path,
        ]);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $galeri = Galeri::findOrFail($id);

        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, string $id)
    {
        $galeri = Galeri::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:30',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $newPath = $request->file('photo')->store('galeri', 'public');

            if ($galeri->photo) {
                Storage::disk('public')->delete($galeri->photo);
            }

            $galeri->photo = $newPath;
        }

        $galeri->title = $validated['title'];
        $galeri->save();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->photo) {
            Storage::disk('public')->delete($galeri->photo);
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}
