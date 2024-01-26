<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $guarded = [
        'id_produk', 'kategori_id', 'kode_produk', 'merk', 'harga_beli', 'harga_jual', 'diskon', 'stok'
    ];

    public function kategori()
    {
        return $this->belongsTo(kategori::class);
    }
    use HasFactory;
}
