<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            // --- MÚSICA (IDs 1 a 10) ---
            ['nome' => 'Heavy Metal & Hard Rock'],      // ID 1
            ['nome' => 'Indie & Alternative'],         // ID 2
            ['nome' => 'Pop & Synthwave'],              // ID 3
            ['nome' => 'Hip Hop & Lo-Fi Beats'],        // ID 4
            ['nome' => 'Trilhas Sonoras (OST)'],        // ID 5
            ['nome' => 'Rock Nacional & Underground'],  // ID 6
            ['nome' => 'Punk & Hardcore'],              // ID 7
            ['nome' => 'Jazz, Blues & Soul'],           // ID 8
            ['nome' => 'MPB & Bossa Nova'],             // ID 9
            ['nome' => 'Eletrônica & Techno'],          // ID 10

            // --- CINEMA & TV (IDs 11 a 20) ---
            ['nome' => 'Sci-Fi & Cyberpunk'],           // ID 11
            ['nome' => 'Terror & Thriller Horror'],     // ID 12
            ['nome' => 'Ação & Blockbusters'],          // ID 13
            ['nome' => 'Documentários Cult'],           // ID 14
            ['nome' => 'Clássicos do Cinema'],          // ID 15
            ['nome' => 'Comédia & Besteirol'],          // ID 16
            ['nome' => 'Drama & Cinema de Arte'],       // ID 17
            ['nome' => 'Séries & Minisséries'],         // ID 18
            ['nome' => 'Animes Clássicos & Modernos'],  // ID 19
            ['nome' => 'Animação Adulta'],              // ID 20

            // --- GAMES (IDs 21 em diante) ---
            ['nome' => 'Retro Gaming (8/16-bit)'],      // ID 21
            ['nome' => 'RPGs & Fantasia Medieval'],     // ID 22
            ['nome' => 'Survival Horror Games'],        // ID 23
            ['nome' => 'E-sports & Competitivo'],       // ID 24
            ['nome' => 'Indie Games Collection'],       // ID 25
            ['nome' => 'Aventura & Open World'],        // ID 26
            ['nome' => 'Luta & Fighting Games'],        // ID 27
            ['nome' => 'FPS & Tiro'],                   // ID 28
        ];

        foreach ($categorias as $cat) {
            Category::create($cat);
        }
    }
}