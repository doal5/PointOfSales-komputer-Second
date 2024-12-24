<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class produkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = produk::with('kategori')->paginate(10);
        $kategori = kategori::all();
        $data = [
            'produk' => $produk,
            'kategori' => $kategori,
            'i' => 1
        ];
        return view('produk.index', $data);
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
        $kategori = kategori::all();
        $data = [
            'kategori' =>  $kategori
        ];
        return view('produk.tambah', $data);
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
            // Data untuk disimpan
            $data = [
                'kategori_id' => $request->kategori,
                'kode_produk' => $kode_produk,
                'produk' => $request->produk,
                'merk' => $request->merk,
                'spesifikasi' => $request->spesifikasi,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'stok' => 0,
                'foto' => $fotoName,
            ];

            // Simpan produk menggunakan fungsi di model
            produk::simpanProduk($data);
        }
        return Redirect()->route('produk.index')->with('sukses', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produk = produk::with('kategori')->find($id);
        $categori = kategori::all();
        $harbel = $produk->harga_beli;
        $harjul = $produk->harga_jual;

        $data = [
            'produk' => $produk,
            'categori' => $categori,
            'harbel' => $harbel,
            'harjul' => $harjul
        ];

        return view('produk.edit', $data);
    }

    public function detail(string $id)
    {
        $data = produk::find($id);
        return view('produk.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        // $id_produk = request->input('id_produk');

        $produk = produk::find($id);
        $produk->spesifikasi = $request->spesifikasi;
        $produk->produk = $request->produk;
        $produk->kategori_id = $request->kategori;
        $produk->merk = $request->merk;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->stok = $request->stok;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            if ($produk->foto) {
                Storage::delete('public/img/produk/' . $produk->foto);
            }
            $fotoName = time() . '.' . $foto->extension();
            $filePath = $foto->move(public_path('img/produk'), $fotoName);
            $produk->foto = $fotoName;
        }
        $produk->update();

        return Redirect()->route('produk.index')->with('sukses', 'Data Berhasil Di Update');
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
