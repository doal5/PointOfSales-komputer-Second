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
        return $this->belongsTo(transaksiDetail::class, 'transaksi_id', 'id');
    }
    public function transaksidetail2()
    {
        return $this->hasMany(transaksiDetail::class, 'transaksi_id', 'id');
    }
    use HasFactory;
}
