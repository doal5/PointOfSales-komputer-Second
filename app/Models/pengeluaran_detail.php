<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengeluaran_detail extends Model
{
    protected $table = 'pengeluaran_detail';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(produk::class, 'id_produk', 'id_produk');
    }
    public function supplier()
    {
        return $this->belongsTo(supplier::class, 'id_supplier', 'id_supplier');
    }

    public function pengeluaran()
    {
        return $this->hasMany(pengeluaran::class);
    }
    use HasFactory;
}
