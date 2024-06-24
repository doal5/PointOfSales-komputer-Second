<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\kategori;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        return view('users.index', compact('data'));
    }


    // Function menampilkan data dari database
    public function read()
    {
        $user = User::all();
        return view('users.read', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::find($id);
        return view('users.edit', compact('data'));
    }

    public function detail(string $id)
    {
        $data = produk::find($id);
        return view('produk.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->name = $request->nama;
        $user->level = $request->level;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->password_dekripsi = $request->password;
        $user->update();
        return redirect()->route('user.index')->with('sukses', 'data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return response()->json('data berhasil dihapus', 200);
    }
    public function destroyMultiple(request $request)
    {
        $ids = $request->ids;
        $idsArray = explode(',', $ids);
        User::destroy($idsArray);
        return response()->json(['status' => true, 'message' => 'Berhasil Hapus Data']);
    }
}
