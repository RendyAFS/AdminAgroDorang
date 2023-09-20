<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Murah extends Model
{
    // protected $table = 'table_murahs';

    protected $fillable = [
        'nama_product',
        'harga_product',
        'satuans_id',
        'deskripsi_product',
        'stok_product',
    ];

    use HasFactory;
    public function satuan()
    {
        return $this->hasMany(Satuan::class);
    }
}
