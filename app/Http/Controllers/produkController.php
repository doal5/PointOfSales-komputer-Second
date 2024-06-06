<?php

namespace App\Http\Controllers;

use App\Models\kategori;
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
        $kategori = kategori::all();
        return view('produk.index', compact('data', 'kategori'));
    }


    // Function menampilkan data dari database
    public function read()
    {
        $kategori = kategori::all();
        $produk = produk::with('kategori')->paginate(10);
        return view('produk.read', compact('produk', 'kategori'));
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

        $request->validate([
            'foto' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $foto = $request->file('foto');
        $fotoName = time() . '.' . $foto->extension();
        $filePath = $foto->move(public_path('img/produk'), $fotoName);


        // pembuatan kode produk
        $produk = produk::latest()->first() ?? new produk();
        $data = new produk();
        $kode_produk = $request['kode_produk'] = 'P' . kode_prodnol((int)$produk->id_produk + 1, 6);

        if ($foto) {
            produk::create([
                'kategori_id' => $request->kategori,
                'kode_produk' => $kode_produk,
                'merk' => $request->merk,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'stok' => $request->stok,
                'foto' => $fotoName,
            ]);
        }
        return response()->json('Data Berhasil Disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = produk::with('kategori')->find($id);
        $categori = kategori::all();
        $harbel = $data->harga_beli;
        $harjul = $data->harga_jual;

        return view('produk.edit', compact('data', 'harbel', 'harjul', 'categori'));
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
        $request->validate([
            'foto' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);
        $foto = $request->file('foto');
        $fotoName = time() . '.' . $foto->extension();
        $filePath = $foto->move(public_path('img/produk'), $fotoName);

        $produk = produk::find($id);
        $produk->kode_produk = $request->kode_produk;
        $produk->kategori_id = $request->kategori;
        $produk->merk = $request->merk;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->stok = $request->stok;
        $produk->foto = $fotoName;
        $produk->update();
        return redirect()->route('produk.index');
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
        return redirect()->json(['status' => true, 'message' => 'data berhasil dihapus']);
    }
}
