<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilKantor extends Model
{
    use HasFactory;

    protected $fillable = [
        'tentang',
        'alamat',
        'telepon',
        'email',
        'fb',
        'ig',
        'tw'
    ];
}
