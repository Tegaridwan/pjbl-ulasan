<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class penjual extends Model
{
    protected $table = 'penjual';
    
    protected $primaryKey = 'Id_Penjual';

    protected $fillable = [
        'Nama_Penjual',
        'Deskripsi',
        'Alamat_Penjual',
        'No_Telp_Penjual',
        
    ];
}
