<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\transaksi;
use App\Models\transaksiDetail;
use Illuminate\Http\Request;

class transaksiDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        $id_produk = $request->id_produk;
        $transaksi_id = $request->transaksi_id;
        $td = transaksiDetail::whereid_produk($id_produk)->wheretransaksi_id($transaksi_id)->first();
        $transaksi = transaksi::find($transaksi_id);
        $tanggal = date('Y-m-d');
        if ($td == null) {
            $data = [
                'id_produk' => $id_produk,
                'transaksi_id' => $transaksi_id,
                'qty' => $request->qty,
                'subtotal' => $request->subtotal,
                'tanggal' => $tanggal,
            ];
            transaksiDetail::create($data);
            $detail = transaksiDetail::find($transaksi_id);
            $dt = [
                'diskon' => $request->diskon + $transaksi->diskon,
                'total' => $request->subtotal + $transaksi->total,
            ];
            $transaksi->update($dt);
        } else {
            $data = [
                'qty' => $td->qty + $request->qty,
                'subtotal' => $td->subtotal + $request->subtotal
            ];
            $td->update($data);

            $dt = [
                'diskon' => $request->diskon + $transaksi->diskon,
                'total' => $request->subtotal + $transaksi->total,
            ];
            $transaksi->update($dt);
        }
        return redirect('transaksi/' . $transaksi_id . '/edit');
    }

    public function delete()
    {
        $id = request('id');
        $td = transaksiDetail::find($id);
        $transaksi = transaksi::find($td->transaksi_id);
        $data = [
            'total' => $transaksi->total - $td->subtotal,
        ];
        $transaksi->update($data);
        $td->delete();
        return redirect()->back();
    }

    public function selesai($id)
    {
        $transaksi = transaksi::find($id);
        $td = transaksiDetail::wheretransaksi_id($id)->get();
        foreach ($td as $item) {
            $produk = produk::find($item->id_produk);
            $produk->stok -= $item->qty;
            $produk->update();
        }
        $data = [
            'status' => 'selesai'
        ];
        $transaksi->update($data);

        return redirect('transaksi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
        //
    }
}
