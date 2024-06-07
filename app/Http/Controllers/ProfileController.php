<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateImage(Request $request, User $user)
    {
        $validated = $request->validate([
            'profile_picture' => 'image|file|max:10240'
        ]);

        if ($request->oldImage == "user-image/unknown.png") {
            $validated['profile_picture'] = $request->file('profile_picture')->store('user-image');
        } else {
            Storage::delete($request->oldImage);
            $validated['profile_picture'] = $request->file('profile_picture')->store('user-image');
        }

        $user->update($validated);

        return redirect()->back()->with([
            'success' => 'Berhasil Mengubah Foto Profil'
        ]);
    }

    public function updateNama(Request $request, User $user)
    {
        $rules = [
            'nama' => 'required',
        ];

        if ($request->input('username') != $user->username) {
            $rules['username'] = 'unique:users,username|required';
        }

        $validated = $request->validate($rules);
        $user->update($validated);

        return redirect()->back()->with([
            'success' => 'Berhasil Mengedit Profil ',
            'nama' => $validated['nama']
        ]);
    }
}
