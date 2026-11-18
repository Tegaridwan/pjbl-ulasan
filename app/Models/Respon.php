<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Respon extends Model
{
    protected $table = 'respon';
    
    protected $fillable = [
        'Id_Respon',
        'Respon',
    ];
    public function ulasan()
    {
        return $this->belongsTo(ulasan::class, 'Id_Respon', 'Id_Ulasan');
    }
}
