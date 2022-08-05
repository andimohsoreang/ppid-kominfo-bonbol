<?php

namespace Database\Seeders;

use App\Models\Klasifikasi;
use Illuminate\Database\Seeder;

class KlasifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Klasifikasi::create([
            'klasifikasi' => 'Tersedia Setiap Saat',
        ]);

        Klasifikasi::create([
            'klasifikasi' => 'Berkala',
        ]);

        Klasifikasi::create([
            'klasifikasi' => 'Serta Merta',
        ]);
    }
}
