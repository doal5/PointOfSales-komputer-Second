<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;

class kategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    public function read()
    {
        $kategori = kategori::all();
        return view('kategori.read', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kategori = new kategori();
        $kategori->kategori = $request->kategori;
        $kategori->save();
        return response()->json('Data Berhasil Disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = kategori::findOrFail($id);
        $kategori->kategori = $request->kategori;
        $kategori->update();
        return view('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = kategori::findOrFail($id);
        $kategori->delete();
        return response()->json('Data Berhasil Dihapus', 200);
    }

    public function destroyMultiple(Request $request)
    {
        $ids = $request->ids;
        kategori::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['status' => true, 'message' => 'data berhasil dihapus']);
    }
}
