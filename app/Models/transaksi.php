<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function transaksidetail()
    {
        return $this->belongsTo(transaksiDetail::class, 'id', 'transaksi_id');
    }
    public function produk()
    {
        return $this->belongsTo(produk::class, 'id', 'id_produk');
    }
    use HasFactory;
}
