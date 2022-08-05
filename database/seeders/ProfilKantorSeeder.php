<?php

namespace Database\Seeders;

use App\Models\ProfilKantor;
use Illuminate\Database\Seeder;

class ProfilKantorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProfilKantor::create([
            'tentang' => 'test bagian',
            'alamat' => 'alamat',
            'telepon' => 'telepon',
            'email' => 'email',
            'fb' => 'fb',
            'ig' => 'ig',
            'tw' => 'tw'
        ]);
    }
}
