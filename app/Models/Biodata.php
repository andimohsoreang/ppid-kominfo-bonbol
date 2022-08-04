<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kategori_pemohon',
        'no_identitas',
        'file_path',
        'alamat',
        'no_telp',
        'pekerjaan',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
