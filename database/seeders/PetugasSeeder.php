<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $petugas = User::create([
            'name' => 'Arif Supu',
            'email' => 'arifsupu@gmail.com',
            'password' => bcrypt('12345')
        ]);

        $petugas->assignRole('petugas');
    }
}
