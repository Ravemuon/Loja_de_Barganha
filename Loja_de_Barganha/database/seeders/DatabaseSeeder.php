<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            MediaFormatSeeder::class,
            ItemSeeder::class,      // Primeiro lote de raridades
            ExtraItemSeeder::class, // O novo lote com itens de nicho
        ]);
    }
}