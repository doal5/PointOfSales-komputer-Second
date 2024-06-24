<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function insertRegistrasi(Request $request)
    {

        // validasi form
        $request->validate([
            'email' => 'required',
            'nama' => 'required',
            'password' => 'required',
            'level' => 'required'
        ], [
            'email.required' => 'Email Harap Diisi',
            'nama.required' => 'nama Harap Diisi',
            'level.required' => 'level Harap Dipilih',
            'password.required' => 'Password Harap Diisi'
        ]);


        // cek email sudah ada atau belum
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->withErrors(['email' => 'email sudah terdaftar'])->withInput();
        }

        // proses insert
        $user = new User();
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->level = $request->level;
        $user->password_dekripsi = $request->password;
        // enkripsi password
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('registrasi')->with('sukses', 'Akun Berhasil Dibuat!!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
