<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email Harap Diisi',
            'password.required' => 'Password Harap Diisi'
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // proses autentikasi login multi role, email dan password
        if (Auth::attempt($data)) {
            // jika login level 1
            if (auth()->user()->level == 1) {
                return redirect()->route('dashboard')->with('success', 'Login Berhasil, Selamat Datang ' . Auth::user()->name);
            } else {
                return redirect()->route('transaksi.index')->with('success', 'Login berhasil, Selamat Datang ' . Auth::user()->name);
            }
        } else {
            return redirect()->route('login')->with('failed', 'Email/Password Salah');
        }
    }

    public function registrasi()
    {
        return view('auth.registrasi');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
