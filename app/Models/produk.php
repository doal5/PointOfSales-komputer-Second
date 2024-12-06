<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(kategori::class);
    }

    public function transaksi_detail()
    {
        return $this->hasMany(transaksiDetail::class, 'id_produk', 'id_produk');
    }

    public function pengeluaran_detail()
    {
        return $this->hasMany(pengeluaran_detail::class, 'id_produk', 'id_produk');
    }
    use HasFactory;

    public static function simpanProduk($data)
    {
        return self::create($data);
    }
}
