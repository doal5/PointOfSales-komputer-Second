<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;

class produkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = produk::all();
        return view('produk.index', compact('data'));
    }


    // Function menampilkan data dari database
    public function read()
    {
        $produk = produk::with('kategori')->paginate(10);
        return view('produk.read', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produk.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new produk();
        $data->merk = $request->merk;
        $data->kode_produk = $request->kode_produk;
        $data->harga_beli = $request->harga_beli;
        $data->harga_jual = $request->harga_jual;
        $data->diskon = $request->diskon;
        $data->stok = $request->stok;
        $data->save();
        return response()->json('Data Berhasil Disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = produk::find($id);
        return view('produk.edit', compact('data'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = produk::findOrFail($id);
        $data->delete();
        return response()->json('data berhasil dihapus', 200);
    }
    public function destroyMultiple(request $request)
    {
        $ids = $request->ids;
        produk::whereIn('id_produk', explode(",", $ids))->delete();
        return response()->json(['status' => true, 'message' => 'data berhasil dihapus']);
    }
}
