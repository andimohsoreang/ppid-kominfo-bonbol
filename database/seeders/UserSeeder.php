<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin Role',
            'email' => 'admin@role.test',
            'password' => bcrypt('12345')
        ]);

        $admin->assignRole('admin');

        $petugas = User::create([
            'name' => 'Petugas Role',
            'email' => 'petugas@role.test',
            'password' => bcrypt('12345')
        ]);

        $petugas->assignRole('petugas');
        

        $user = User::create([
            'name' => 'User Role',
            'email' => 'user@role.test',
            'password' => bcrypt('12345')
        ]);

        $user->assignRole('user');
    
    
    }
}
