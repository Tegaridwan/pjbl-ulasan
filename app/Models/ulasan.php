<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ulasan extends Model
{
    protected $table = 'ulasan';
    protected $primaryKey = 'Id_Ulasan';

    protected $fillable = [
        'Id_Penjual',
        'Nama_Pembeli',
        'Ulasan',
        'Rating',
    ];
}
