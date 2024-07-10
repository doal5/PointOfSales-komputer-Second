<?php

namespace App\Http\Controllers;

use App\Models\pengeluaran;
use App\Models\pengeluaran_detail;
use App\Models\produk;
use App\Models\supplier;
use App\Models\transaksiDetail;
use Illuminate\Http\Request;

class pengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengeluaran = pengeluaran::paginate(10);
        return view('pengeluaran.index', compact('pengeluaran'));
    }


    // Function menampilkan data dari database
    public function read()
    {
        $pengeluaran = pengeluaran::with('supplier', 'pengeluaran_detail')->where('total', '>', 0)->paginate(10);
        $data = [
            'pengeluaran' => $pengeluaran,
        ];
        return view('pengeluaran.read', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'total' => 0
        ];
        $pengeluaran = pengeluaran::create($data);
        return redirect('pengeluaran/' . $pengeluaran->id . '/edit');
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
        $data = pengeluaran::find($id);
        return view('pengeluaran.edit', compact('data'));
    }

    public function detail(string $id)
    {
        $data = pengeluaran::find($id);
        return view('produk.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'pengeluaran' => pengeluaran::find($id),
            'produk' => produk::all(),
            'supplier' => supplier::all(),
            'subtotal' => 0,
            'pengeluarandetail' => pengeluaran_detail::wherepengeluaran_id($id)->with('produk', 'supplier')->get()
        ];
        return view('pengeluaran.tambah', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = pengeluaran::find($id);
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
        $data = pengeluaran::findOrFail($id);
        $data->delete();
        return response()->json('data berhasil dihapus', 200);
    }
    public function destroyMultiple(request $request)
    {
        $ids = $request->ids;
        $idsArray = explode(',', $ids);
        pengeluaran::destroy($idsArray);
        return response()->json(['status' => true, 'message' => 'Berhasil Hapus Data']);
    }
}
