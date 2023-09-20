<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    // protected $table = 'table_satuans';
    use HasFactory;
    public function mahal()
    {
        return $this->belongsTo(Mahal::class , 'satuans_id');
    }
    public function murah()
    {
        return $this->belongsTo(Murah::class, 'satuans_id');
    }
}
