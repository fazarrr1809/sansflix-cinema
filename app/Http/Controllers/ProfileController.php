<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // Gunakan Storage bukan File
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function index() {
        $user = Auth::user();
        
        // Hitung umur otomatis dari kolom dob
        $age = Carbon::parse($user->dob)->age;

        return view('profile.index', compact('user', 'age')); 
    }

    public function update(Request $request) {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'dob' => $user->dob ? 'nullable' : 'required|date|before:today',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Update Tanggal Lahir jika sebelumnya kosong
        if (!$user->dob && $request->filled('dob')) {
            $user->dob = $request->dob;
        }

        // Logika Ganti Password
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
            }
            $user->password = Hash::make($request->new_password);
        }

        // Logika Avatar (Sudah diperbaiki agar konsisten)
        if ($request->hasFile('avatar')) {
            // Hapus foto lama dari storage jika ada
            if ($user->avatar && !str_starts_with($user->avatar, 'http')) {
                Storage::disk('public')->delete('uploads/avatars/' . $user->avatar);
            }

            // Simpan file baru ke storage/app/public/uploads/avatars
            $path = $request->file('avatar')->store('uploads/avatars', 'public');
            
            // Simpan nama filenya saja ke database
            $user->avatar = basename($path);
        }

        // Update data dasar (PENTING: Bagian ini harus ada agar nama/username terupdate)
        $user->name = $request->name;
        $user->username = $request->username;
        $user->save();

        // PENTING: Harus ada RETURN agar tidak blank putih
        return back()->with('success', 'Profil dan keamanan berhasil diperbarui!');
    }
}