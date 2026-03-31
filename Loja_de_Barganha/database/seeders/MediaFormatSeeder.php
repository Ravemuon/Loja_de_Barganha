<?php

namespace Database\Seeders;

use App\Models\MediaFormat;
use Illuminate\Database\Seeder;

class MediaFormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formatos = [
            // --- MÚSICA & ÁUDIO (IDs 1 a 3) ---
            ['nome' => 'Vinil (LP/Compacto)'],        // ID 1
            ['nome' => 'CD (Áudio)'],                 // ID 2
            ['nome' => 'Fita Cassete (K7)'],          // ID 3

            // --- FILMES & VÍDEO (IDs 4 a 6) ---
            ['nome' => 'DVD'],                        // ID 4
            ['nome' => 'Blu-ray'],                    // ID 5
            ['nome' => 'Fita VHS'],                   // ID 6

            // --- JOGOS (MÍDIA FÍSICA) (IDs 7 a 10) ---
            ['nome' => 'Cartucho (Retro)'],           // ID 7
            ['nome' => 'CD-ROM (PS1/PC)'],            // ID 8
            ['nome' => 'DVD-ROM (PS2/Xbox/PC)'],      // ID 9
            ['nome' => 'Cartão de Jogo (Switch/DS)'], // ID 10

            // --- DIGITAL & OUTROS (IDs 11 em diante) ---
            ['nome' => 'Mídia Digital (Código)'],     // ID 11
            ['nome' => 'Edição de Colecionador'],      // ID 12
        ];

        foreach ($formatos as $f) {
            MediaFormat::create($f);
        }
    }
}