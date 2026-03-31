<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ExtraItemSeeder extends Seeder
{
    public function run(): void
    {
        $itens = [
            // --- MÚSICA (Categorias 1-10) ---
            [
                'titulo' => 'Roots',
                'artista_diretor' => 'Sepultura',
                'empresa_produtora' => 'Roadrunner Records',
                'preco' => 320.00,
                'category_id' => 1, // Heavy Metal & Hard Rock
                'media_format_id' => 1, // Vinil
                'tipo_midia' => 'Música',
                'descricao' => 'Edição limitada em vinil duplo. O auge do Metal brasileiro.',
                'user_id' => 1
            ],
            [
                'titulo' => 'Random Access Memories',
                'artista_diretor' => 'Daft Punk',
                'empresa_produtora' => 'Columbia Records',
                'preco' => 380.00,
                'category_id' => 3, // Pop & Synthwave
                'media_format_id' => 1, // Vinil
                'tipo_midia' => 'Música',
                'descricao' => 'Vinil duplo 180g. Edição de 10º aniversário.',
                'user_id' => 1
            ],
            [
                'titulo' => 'Transa',
                'artista_diretor' => 'Caetano Veloso',
                'empresa_produtora' => 'Philips',
                'preco' => 300.00,
                'category_id' => 9, // MPB & Bossa Nova
                'media_format_id' => 1, // Vinil
                'tipo_midia' => 'Música',
                'descricao' => 'Capa "Triple-fold" original de 1972. Clássico absoluto.',
                'user_id' => 1
            ],

            // --- CINEMA & TV (Categorias 11-20) ---
            [
                'titulo' => 'Blade Runner (The Final Cut)',
                'artista_diretor' => 'Ridley Scott',
                'empresa_produtora' => 'Warner Bros',
                'elenco_detalhes' => 'Harrison Ford, Rutger Hauer',
                'preco' => 120.00,
                'category_id' => 11, // Sci-Fi & Cyberpunk
                'media_format_id' => 5, // Blu-ray
                'tipo_midia' => 'Filme',
                'descricao' => 'Steelbook exclusivo. Versão definitiva aprovada pelo diretor.',
                'user_id' => 1
            ],
            [
                'titulo' => 'O Iluminado',
                'artista_diretor' => 'Stanley Kubrick',
                'empresa_produtora' => 'Warner Bros',
                'elenco_detalhes' => 'Jack Nicholson, Shelley Duvall',
                'preco' => 45.00,
                'category_id' => 12, // Terror & Thriller Horror
                'media_format_id' => 4, // DVD
                'tipo_midia' => 'Filme',
                'descricao' => 'Edição especial com documentário de bastidores.',
                'user_id' => 1
            ],
            [
                'titulo' => 'Stranger Things - 1ª Temporada',
                'artista_diretor' => 'The Duffer Brothers',
                'empresa_produtora' => 'Netflix',
                'elenco_detalhes' => 'Millie Bobby Brown, Winona Ryder',
                'preco' => 250.00,
                'category_id' => 18, // Séries & Minisséries
                'media_format_id' => 5, // Blu-ray
                'tipo_midia' => 'Filme',
                'descricao' => 'Edição de colecionador simulando uma fita VHS.',
                'user_id' => 1
            ],
            [
                'titulo' => 'Jaspion: Box Completo',
                'artista_diretor' => 'Toei Company',
                'empresa_produtora' => 'Focus Filmes',
                'elenco_detalhes' => 'Hikaru Kurosaki',
                'preco' => 180.00,
                'category_id' => 19, // Animes Clássicos & Modernos
                'media_format_id' => 4, // DVD
                'tipo_midia' => 'Filme',
                'descricao' => 'Série completa em 10 DVDs. Dublagem original.',
                'user_id' => 1
            ],

            // --- GAMES (Categorias 21-28) ---
            [
                'titulo' => 'Super Metroid',
                'artista_diretor' => 'Yoshio Sakamoto',
                'empresa_produtora' => 'Nintendo',
                'preco' => 800.00,
                'category_id' => 21, // Retro Gaming (8/16-bit)
                'media_format_id' => 7, // Cartucho
                'tipo_midia' => 'Jogo',
                'descricao' => 'Cartucho original SNES. Label em perfeito estado.',
                'user_id' => 1
            ],
            [
                'titulo' => 'Chrono Trigger',
                'artista_diretor' => 'Akira Toriyama',
                'empresa_produtora' => 'Square',
                'preco' => 1200.00,
                'category_id' => 22, // RPGs & Fantasia Medieval
                'media_format_id' => 7, // Cartucho
                'tipo_midia' => 'Jogo',
                'descricao' => 'Relíquia do SNES. Inclui manual original.',
                'user_id' => 1
            ],
            [
                'titulo' => 'Resident Evil 2',
                'artista_diretor' => 'Hideki Kamiya',
                'empresa_produtora' => 'Capcom',
                'preco' => 350.00,
                'category_id' => 23, // Survival Horror Games
                'media_format_id' => 8, // CD-ROM (PS1)
                'tipo_midia' => 'Jogo',
                'descricao' => 'Edição DualShock original PS1 com os 2 CDs.',
                'user_id' => 1
            ],
            [
                'titulo' => 'DOOM (1993)',
                'artista_diretor' => 'John Romero',
                'empresa_produtora' => 'id Software',
                'preco' => 950.00,
                'category_id' => 28, // FPS & Tiro
                'media_format_id' => 11, // Mídia Digital
                'tipo_midia' => 'Jogo',
                'descricao' => 'O pai dos FPS modernos.',
                'user_id' => 1
            ],
            [
                'titulo' => 'Mortal Kombat II',
                'artista_diretor' => 'Ed Boon',
                'empresa_produtora' => 'Midway',
                'preco' => 220.00,
                'category_id' => 27, // Luta & Fighting Games
                'media_format_id' => 7, // Cartucho
                'tipo_midia' => 'Jogo',
                'descricao' => 'Clássico do SNES.',
                'user_id' => 1
            ],
        ];

        foreach ($itens as $item) {
            Item::create($item);
        }
    }
}