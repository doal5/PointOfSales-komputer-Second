<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengeluaran extends Model
{
    protected $table = 'pengeluaran';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(supplier::class, 'id_supplier', 'id_supplier');
    }

    public function pengeluaran_detail()
    {
        return $this->belongsTo(pengeluaran_detail::class);
    }
    use HasFactory;
}
