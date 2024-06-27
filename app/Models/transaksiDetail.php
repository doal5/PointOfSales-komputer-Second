<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksiDetail extends Model
{
    protected $table = 'transaksi_detail';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(produk::class, 'id_produk', 'id_produk');
    }
    public function transaksi()
    {
        return $this->hasMany(transaksi::class, 'id', 'transaksi_id');
    }
    public function transaksi2()
    {
        return $this->belongsTo(transaksi::class, 'transaksi_id', 'id');
    }
    use HasFactory;
}
