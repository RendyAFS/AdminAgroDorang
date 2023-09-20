<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahal extends Model
{
    // protected $table = 'table_mahals';
    use HasFactory;

    public function satuan()
    {
        return $this->hasMany(Satuan::class);
    }
    protected $fillable = [
        'nama_product',
        'harga_product',
        'satuans_id',
        'deskripsi_product',
        'stok_product',
    ];
}
