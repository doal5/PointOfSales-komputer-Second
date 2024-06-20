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
            'email.required' => 'Username Harap Diisi',
            'password.required' => 'Password Harap Diisi'
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // proses autentikasi login email dan password
        if (Auth::attempt($data)) {
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        } else {
            return redirect()->route('login');
        }
    }

    public function registrasi()
    {
        return view('auth.registrasi');
    }
}
