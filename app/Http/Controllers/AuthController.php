<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index()
    {
        return view('main.login');
    }

    public function home()
    {
        if (Auth::check()) {
            if (auth()->user()->role_id == 1) {
                return redirect('/admin');
            } else if (auth()->user()->role_id == 2) {
                return redirect('/guru');
            } else if (auth()->user()->role_id == 3) {
                return redirect('/siswa');
            }
        } else {
            return redirect('/login')->with([
                'failed' => 'Terdapat Kesalahan Pada Username / Password'
            ]);
        }
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return redirect('/login')->with('failed', 'Username / Password Tidak Valid');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
