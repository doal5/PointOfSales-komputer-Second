<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use Illuminate\Http\Request;

class supplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Data Supplier'
        ];
        return view('supplier.index', $data);
    }

    public function read()
    {
        $supplier = supplier::all();
        return view('supplier.read', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $supplier = new supplier();
        $supplier->nama = $request->nama;
        $supplier->email = $request->email;
        $supplier->no_telepon = $request->no_telepon;
        $supplier->alamat = $request->alamat;
        $supplier->save();
        return response()->json('Data Berhasil Disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = supplier::find($id);
        return view('supplier.edit', compact('supplier'));
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
        $supplier = supplier::findOrFail($id);
        $supplier->nama = $request->nama;
        $supplier->email = $request->email;
        $supplier->no_telepon = $request->no_telepon;
        $supplier->alamat = $request->alamat;
        $supplier->update();
        return response()->json('Data Berhasil Di Update', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = supplier::find($id);
        $supplier->delete();
        return response()->json('Data Berhasil Dihapus', 200);
    }
    public function destroymultiple(Request $request)
    {
        $ids = $request->ids;
        supplier::whereIn('id_supplier', explode(",", $ids))->delete();
        return response()->json(['status' => true, 'message' => 'data berhasil dihapus']);
    }
}
