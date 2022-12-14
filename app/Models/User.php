<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use PDO;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function informasipublik()
    {
        return $this->hasMany(InformasiPublik::class);
    }

    public function biodata()
    {
        return $this->hasOne(Biodata::class);
    }

    public function permohonaninformasi()
    {
        return $this->hasMany(PermohonanInformasi::class);
    }

    public function petugaspermohonaninformasi()
    {
        return $this->hasMany(PermohonanInformasi::class);
    }

    public function pengajuankeberatan()
    {
        return $this->hasMany(PengajuanKeberatan::class);
    }
}
