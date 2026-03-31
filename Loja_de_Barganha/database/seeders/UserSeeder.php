<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin Loja',
            'email' => 'admin@barganha.com',
            'password' => bcrypt('admin123'),
        ]);

        \App\Models\User::create([
            'name' => 'Usuario Comum',
            'email' => 'user@teste.com',
            'password' => bcrypt('user123'),
        ]);
    }
}
