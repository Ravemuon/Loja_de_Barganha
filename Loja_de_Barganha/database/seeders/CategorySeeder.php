<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            // --- MÚSICA ---
            ['nome' => 'Heavy Metal & Hard Rock', 'tipo_midia' => 'Música', 'icone' => 'bi-fire'],
            ['nome' => 'Indie & Alternative', 'tipo_midia' => 'Música', 'icone' => 'bi-megaphone'],
            ['nome' => 'Pop & Synthwave', 'tipo_midia' => 'Música', 'icone' => 'bi-activity'],
            ['nome' => 'Hip Hop & Lo-Fi Beats', 'tipo_midia' => 'Música', 'icone' => 'bi-boombox'],
            ['nome' => 'Trilhas Sonoras (OST)', 'tipo_midia' => 'Música', 'icone' => 'bi-music-note-list'],
            ['nome' => 'Rock Nacional & Underground', 'tipo_midia' => 'Música', 'icone' => 'bi-vinyl-fill'],
            ['nome' => 'Punk & Hardcore', 'tipo_midia' => 'Música', 'icone' => 'bi-lightning-charge-fill'],
            ['nome' => 'Jazz, Blues & Soul', 'tipo_midia' => 'Música', 'icone' => 'bi-sax-fill'],
            ['nome' => 'MPB & Bossa Nova', 'tipo_midia' => 'Música', 'icone' => 'bi-flower1'],
            ['nome' => 'Eletrônica & Techno', 'tipo_midia' => 'Música', 'icone' => 'bi-cpu'],

            // --- CINEMA & TV ---
            ['nome' => 'Sci-Fi & Cyberpunk', 'tipo_midia' => 'Filme', 'icone' => 'bi-robot'],
            ['nome' => 'Terror & Thriller Horror', 'tipo_midia' => 'Filme', 'icone' => 'bi-ghost'],
            ['nome' => 'Ação & Blockbusters', 'tipo_midia' => 'Filme', 'icone' => 'bi-boombox-fill'],
            ['nome' => 'Documentários Cult', 'tipo_midia' => 'Filme', 'icone' => 'bi-camera-reels'],
            ['nome' => 'Clássicos do Cinema', 'tipo_midia' => 'Filme', 'icone' => 'bi-film'],
            ['nome' => 'Comédia & Besteirol', 'tipo_midia' => 'Filme', 'icone' => 'bi-emoji-laughing'],
            ['nome' => 'Drama & Cinema de Arte', 'tipo_midia' => 'Filme', 'icone' => 'bi-masks'],
            ['nome' => 'Séries & Minisséries', 'tipo_midia' => 'Filme', 'icone' => 'bi-tv'],
            ['nome' => 'Animes Clássicos & Modernos', 'tipo_midia' => 'Filme', 'icone' => 'bi-incognito'],
            ['nome' => 'Animação Adulta', 'tipo_midia' => 'Filme', 'icone' => 'bi-palette'],

            // --- GAMES ---
            ['nome' => 'Retro Gaming (8/16-bit)', 'tipo_midia' => 'Jogo', 'icone' => 'bi-joystick'],
            ['nome' => 'RPGs & Fantasia Medieval', 'tipo_midia' => 'Jogo', 'icone' => 'bi-shield-shaded'],
            ['nome' => 'Survival Horror Games', 'tipo_midia' => 'Jogo', 'icone' => 'bi-biohazard'],
            ['nome' => 'E-sports & Competitivo', 'tipo_midia' => 'Jogo', 'icone' => 'bi-trophy'],
            ['nome' => 'Indie Games Collection', 'tipo_midia' => 'Jogo', 'icone' => 'bi-patch-check'],
            ['nome' => 'Aventura & Open World', 'tipo_midia' => 'Jogo', 'icone' => 'bi-compass'],
            ['nome' => 'Luta & Fighting Games', 'tipo_midia' => 'Jogo', 'icone' => 'bi-person-arms-up'],
            ['nome' => 'FPS & Tiro', 'tipo_midia' => 'Jogo', 'icone' => 'bi-crosshair'],
        ];

        foreach ($categorias as $cat) {
            Category::create($cat);
        }
    }
}