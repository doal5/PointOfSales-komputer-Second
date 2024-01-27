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
    use HasFactory;
}
