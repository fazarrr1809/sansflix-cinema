<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function index() {
        $user = Auth::user();
        
        // Hitung umur otomatis dari kolom dob
        $age = \Carbon\Carbon::parse($user->dob)->age;

        // PASTIKAN menggunakan tanda $ di dalam compact
        return view('profile.index', compact('user', 'age')); 
    }

    public function update(Request $request) {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            // Validasi password opsional (hanya jika diisi)
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Logika Ganti Password
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
            }
            $user->password = Hash::make($request->new_password);
        }

        // Logika Avatar
        if ($request->hasFile('avatar')) {
            if ($user->avatar && !str_starts_with($user->avatar, 'http')) {
                File::delete(public_path('uploads/avatars/' . $user->avatar));
            }
            $fileName = time() . '_' . $user->id . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('uploads/avatars'), $fileName);
            $user->avatar = $fileName;
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->save();

        return back()->with('success', 'Profil dan keamanan berhasil diperbarui!');
    }
}