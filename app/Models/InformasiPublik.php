<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiPublik extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'klasifikasi_id',
        'judul',
        'ringkasan',
        'file',
        'filesize'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function klasifikasi()
    {
        return $this->belongsTo(Klasifikasi::class, 'klasifikasi_id', 'id');
    }
}
