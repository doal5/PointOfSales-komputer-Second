<?php

namespace App\Http\Controllers;

use App\Models\pengeluaran;
use App\Models\pengeluaran_detail;
use App\Models\produk;
use Illuminate\Http\Request;

class pengeluarandetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_pengeluaran = $request->pengeluaran_id;
        $id_produk = $request->id_produk;
        $qty = $request->qty;
        $subtotal = $request->subtotal;
        $keterangan = $request->keterangan;
        $id_supplier = $request->id_supplier;
        $produk = produk::find($id_produk);
        $pengeluaran = pengeluaran::find($id_pengeluaran);
        $pd = pengeluaran_detail::whereid_produk($id_produk)->wherepengeluaran_id($id_pengeluaran)->first();
        if ($pd == null) {
            $data = [
                'pengeluaran_id' => $id_pengeluaran,
                'id_produk' => $id_produk,
                'qty' => $qty,
                'id_supplier' => $id_supplier,
                'subtotal' => $subtotal
            ];

            pengeluaran_detail::create($data);
            $pd = pengeluaran_detail::find($id_pengeluaran);

            $dtpengeluaran = [
                'total' => $pengeluaran->total + $subtotal,
                'keterangan' => $keterangan
            ];
            $pengeluaran->update($dtpengeluaran);

            $dtproduk = [
                // 'kategori_id' => $produk->kategori_id,
                // 'kode_produk' => $produk->kode_produk,
                // 'merk' => $produk->merk,
                // 'harga_beli' => $produk->harga_beli,
                // 'harga_jual' => $produk->harga_jual,
                'stok' => $produk->stok + $qty,
                // 'foto' => $produk->foto,
            ];
            $produk->update($dtproduk);
        } else {
            $data = [
                'qty' => $pd->qty + $qty
            ];
            $pd->update($data);

            $dtproduk = [
                'stok' => $produk->stok + $qty
            ];
            $produk->update($dtproduk);
        }
        return redirect('pengeluaran/' . $pengeluaran->id . '/edit')->withInput();
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

    public function delete()
    {
        $id = request('id');
        $pd = pengeluaran_detail::find($id);
        $pengeluaran = pengeluaran::find($pd->pengeluaran_id);
        $produk = produk::find($pd->id_produk);

        // pengurangan total pada table pengeluaran
        $data = [
            'total' => $pengeluaran->total - $pd->subtotal
        ];
        $pengeluaran->update($data);

        // pengurangan stok
        $pdata = [
            'stok' => $produk->stok - $pd->qty
        ];
        $produk->update($pdata);

        $pd->delete();
        return redirect('pengeluaran/' . $pengeluaran->id . '/edit')->withInput();
    }
}
