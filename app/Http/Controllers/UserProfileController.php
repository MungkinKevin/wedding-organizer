<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    // memperbarui Nama & Nomor
    public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();
        $user->name = $request->name;

        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    // mengunggah Foto Profil
    public function updatePhoto(Request $request)
    {
        // Validasi file foto
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            // Simpan gambar ke storage/app/public/avatars
            $path = $request->file('avatar')->store('avatars', 'public');

            // Simpan lokasi file gambar ke kolom avatar di database
            $user->avatar = $path;
            $user->save();
        }

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
    }

    // 3. mengubah Kata Sandi
    public function updatePassword(Request $request)
    {
        // Validasi input form password
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Simpan password baru setelah di-hash
        $user = Auth::user();
        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Kata sandi berhasil diubah!');
    }
}