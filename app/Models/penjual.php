<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class penjual extends Model
{
    protected $table = 'penjual';
    protected $primaryKey = 'Id_Penjual';

    protected $fillable = [
        'Id_User',
        'Nama_Penjual',
        'Deskripsi',
        'Alamat_Penjual',
        'No_Telp_Penjual',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'Id_User', 'id');
    }

    public function ulasan()
    {
        return $this->hasMany(ulasan::class, 'Id_Penjual', 'Id_Penjual');
    }
}