<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\transaksi;
use App\Models\transaksiDetail;
use Illuminate\Http\Request;

class transaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Transaksi',
            'transaksi' => transaksi::with('transaksidetail')->where('total', '>', 0)->paginate(10),
        ];
        return view('transaksi.index', $data);
    }

    public function hapusmultiple(request $request)
    {
        $ids = $request->ids;
        $transaksi = transaksi::whereIn('id', explode(',', $ids))->delete();

        $td = transaksiDetail::whereIn('transaksi_id', explode(',', $ids))->delete();

        return response()->json(['status' => true, 'message' => 'data berhasil dihapus']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $diskon = 0;
        $total = 0;
        $tanggal = date('Y-m-d');
        $data = [
            'diskon' => $diskon,
            'total' => $total,
            'tanggal' => $tanggal
        ];
        $transaksi = transaksi::create($data);
        return redirect('transaksi/' . $transaksi->id . '/edit');
    }


    public function kembali($id)
    {
        $transaksi = transaksi::find($id);
        $transaksi->delete();
        return redirect()->route('transaksi.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaksidetail = transaksiDetail::where('transaksi_id', $id)->with('produk')->get();


        $produk = produk::all();
        $id_produk = request('id_produk');
        $pdetail = produk::find($id_produk);
        $qty = request('qty');
        $act  = request('act');

        if ($act == 'min') {
            if ($qty <= 1) {
                $qty = 1;
            } else {
                $qty = $qty - 1;
            }
        } else {
            $qty = $qty + 1;
        }
        $subtotal = 0;
        $diskon = 0;

        if ($pdetail) {
            $subtotal = $pdetail->harga_jual * $qty;
        }

        $transaksi = transaksi::find($id);
        $dibayarkan = request('dibayarkan');
        $diskon = request('diskon');
        $tanggal = date('Y-m-d');

        $nomDiskon = ($transaksi->total * $diskon) / 100;

        if ($dibayarkan) {
            $dt = [
                'diskon' => $diskon,
                'total' => $transaksi->total - $nomDiskon,
                'tanggal' => $tanggal
            ];
            $transaksi->update($dt);
        } else {
            $dt = [
                'diskon' => $diskon,
                'total' => $transaksi->total,
                'tanggal' => $tanggal
            ];
        }

        if ($dibayarkan) {

            $kembalian = $dibayarkan - $transaksi->total;
        }

        $data = [
            'title' => 'Tambah Transaksi',
            'produk' => $produk,
            'qty' => $qty,
            'pdetail' => $pdetail,
            'subtotal' => $subtotal,
            'transaksidetail' => $transaksidetail,
            'transaksi' => $transaksi,
            'kembalian' => $kembalian ?? 0,
            'dibayarkan' => $dibayarkan,
            'diskon' => $diskon,
        ];

        return view('transaksi.tambah', $data);
    }

    public function updateDiskonTotal(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:transaksi,id',
            'diskon' => 'required|numeric|min:0|max:100',
            'total_belanja' => 'required|numeric|min:0',
        ]);

        // Cari transaksi berdasarkan ID
        $transaksi = Transaksi::find($request->id);

        // Update diskon dan total belanja
        $transaksi->diskon = $request->diskon;
        $transaksi->total = $request->total_belanja;
        $transaksi->save();

        return response()->json(['success' => true, 'message' => 'Transaksi berhasil diperbarui.']);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tid = $request->transaksi_id;
        $idp = $request->id_produk;
        $qty = $request->qty;
        $transaksidetail = transaksiDetail::find($tid);
    }

    public function detail($id)
    {
        $transaksi = transaksiDetail::with('produk')->where('transaksi_id', $id)->get();
        return view('transaksi.detail', compact('transaksi'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getProduk($id)
    {
        $produk = produk::find($id);
        return response()->json($produk);
    }
}
