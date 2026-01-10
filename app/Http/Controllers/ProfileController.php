<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index() {
        return view('profile.index', ['user' => Auth::user()]);
    }

    public function update(Request $request) {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            // Hapus foto lama jika ada dan bukan dari Google
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

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}