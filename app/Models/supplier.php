<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';
    protected $guarded = [];

    public function pengeluaran()
    {
        return $this->hasMany(pengeluaran::class, 'id_supplier', 'id_supplier');
    }
    public function pengeluaran_detail()
    {
        return $this->hasMany(pengeluaran_detail::class, 'id_supplier', 'id_supplier');
    }
    use HasFactory;
}
