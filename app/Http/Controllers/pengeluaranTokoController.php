<?php

namespace App\Http\Controllers;

use App\Models\pengeluaran;
use Illuminate\Http\Request;

class pengeluaranTokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data pengeluaran yang totalnya lebih dari 0 dan keterangan tidak kosong
        $pengeluaran = pengeluaran::where('total', '>', 0)
            ->whereNotNull('keterangan') // Field 'keterangan' tidak null
            ->where('keterangan', '!=', '') // Field 'keterangan' tidak kosong
            ->paginate(10);
        $data = [
            'pengeluaranToko' => $pengeluaran,
            'i' => 1
        ];
        return view('pengeluaranToko.index', $data);
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
