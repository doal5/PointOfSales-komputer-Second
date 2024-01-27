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
        'user_id',
        'subtotal',
        'kasir_name',
        'status'
    ];
    use HasFactory;
}
