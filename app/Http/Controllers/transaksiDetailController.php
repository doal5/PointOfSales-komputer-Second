<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\transaksi;
use App\Models\transaksiDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class transaksiDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

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
                'subtotal' => $request->harga_jual * $request->qty,
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
        $cekt = transaksiDetail::where('transaksi_id', $td->transaksi_id)->count();

        if ($cekt > 1) {
            $data = [
                'total' => $transaksi->total - $td->subtotal,
            ];
        } else {
            $data = [
                'total' => 0,
            ];
        }
        $transaksi->update($data);
        $td->delete();
        return redirect()->back();
    }

    public function selesai($id)
    {
        $transaksi = transaksi::find($id);
        $td = transaksiDetail::wheretransaksi_id($id)->with('produk')->get();
        $date = date('d F Y');
        foreach ($td as $item) {
            $produk = produk::find($item->id_produk);
            $produk->stok -= $item->qty;
            $produk->update();
        }

        $invoice = [
            'transaksi' => $transaksi,
            'td' => $td,
            'tanggal' => $date
        ];

        $data = [
            'status' => 'selesai'
        ];
        $transaksi->update($data);

        return redirect('transaksi');
    }

    public function updateQty(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id_produk' => 'required|exists:produk,id_produk',
            'transaksi_id' => 'nullable', // Boleh kosong karena bisa kita buat baru
            'qty' => 'required|integer|min:1',
            'harga_jual' => 'required|numeric', // Validasi harga_jual
        ]);

        // Cek apakah transaksi_id ada atau tidak
        if (!$validated['transaksi_id']) {
            // Buat transaksi baru jika belum ada
            $transaksi = Transaksi::create([
                // Tambahkan field transaksi yang dibutuhkan, contoh:
                'tanggal' => Carbon::now(),
                'status' => 'baru', // Atur status transaksi default
                // Tambahkan field lain sesuai kebutuhan
            ]);

            // Assign id transaksi baru ke variabel transaksi_id
            $transaksi_id = $transaksi->id;
        } else {
            // Jika transaksi sudah ada, ambil transaksi_id dari request
            $transaksi_id = $validated['transaksi_id'];
        }

        // Cek apakah detail transaksi sudah ada
        $transaksiDetail = TransaksiDetail::where('id_produk', $validated['id_produk'])
            ->where('transaksi_id', $transaksi_id)
            ->first();

        if ($transaksiDetail) {
            // Jika detail transaksi sudah ada, update qty dan subtotal
            $transaksiDetail->qty = $validated['qty'];
            $transaksiDetail->subtotal = $validated['harga_jual'] * $validated['qty'];
            $transaksiDetail->save();
        } else {
            // Jika belum ada, buat detail transaksi baru
            $transaksiDetail = TransaksiDetail::create([
                'id_produk' => $validated['id_produk'],
                'transaksi_id' => $transaksi_id,
                'qty' => $validated['qty'],
                'subtotal' => $validated['harga_jual'] * $validated['qty'], // Hitung subtotal
                'tanggal' => Carbon::now()
            ]);
        }

        // Kembalikan response dengan format JSON
        return response()->json([
            'success' => true,
            'subtotal' => number_format($transaksiDetail->subtotal, 0, ',', '.'),
            'transaksi_id' => $transaksi_id, // Kembalikan transaksi_id yang dibuat atau diambil
        ]);
    }

    public function invoice($id)
    {
        $transaksi = transaksi::find($id);
        $td = transaksiDetail::wheretransaksi_id($id)->with('produk')->get();
        $date = date('d F Y');

        $invoice = [
            'transaksi' => $transaksi,
            'td' => $td,
            'tanggal' => $date
        ];



        $data = [
            'title' => 'Transaksi',
            'transaksi' => transaksi::with('transaksidetail')->paginate(10),
        ];
        $pdf = Pdf::loadview('transaksi.invoice', $invoice);
        return $pdf->download('invoice.pdf');
        // Simpan PDF ke penyimpanan lokal
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

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
