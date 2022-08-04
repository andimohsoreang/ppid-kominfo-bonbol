<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanInformasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rincian',
        'tujuan',
        'mendapat',
        'cara',
        'status',
        'alasan_tolak',
        'petugas_id',
        'pesan',
        'file',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id', 'id');
    }

    public function pengajuankeberatan()
    {
        return $this->hasOne(PengajuanKeberatan::class, 'permoinfo_id', 'id');
    }
}
