<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
        'diskon',
        'total',
        'status'
    ];
    use HasFactory;
}
