<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klasifikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'klasifikasi'
    ];

    public function informasipublik()
    {
        return $this->hasMany(InformasiPublik::class, 'klasifikasi_id', 'id');
    }
}
