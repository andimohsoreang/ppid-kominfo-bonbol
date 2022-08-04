<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanKeberatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'permoinfo_id',
        'pesan',
        'status',
        'alasan',
    ];


    public function permohonaninformasi()
    {
        return $this->belongsTo(PermohonanInformasi::class, 'permoinfo_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
