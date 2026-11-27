<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    // Menampilkan halaman Settings
    public function index()
    {
        return view('settings.index');
    }

    // Memperbarui profil
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
        ]);

        $user->update($validated);

        return redirect()->route('settings.index')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    // Memperbarui password
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('settings.index')
            ->with('success', 'Password berhasil diperbarui!');
    }
}
