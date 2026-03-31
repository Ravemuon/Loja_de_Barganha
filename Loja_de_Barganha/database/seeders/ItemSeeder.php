<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $itens = [
            // --- MÚSICA (Categorias 1-10 | Formatos 1-3) ---
            [
                'titulo' => 'Mamonas Assassinas',
                'artista_diretor' => 'Mamonas Assassinas',
                'empresa_produtora' => 'EMI',
                'preco' => 150.00,
                'category_id' => 6, // Rock Nacional
                'media_format_id' => 1, // Vinil
                'tipo_midia' => 'Música',
                'descricao' => 'LP Original de 1995. Inclui encarte raro.',
                'user_id' => 1
            ],
            [
                'titulo' => 'Raining Blood (Single)',
                'artista_diretor' => 'Slayer',
                'empresa_produtora' => 'Def Jam',
                'preco' => 120.00,
                'category_id' => 1, // Heavy Metal
                'media_format_id' => 1, // Vinil
                'tipo_midia' => 'Música',
                'descricao' => 'Compacto 7 polegadas. Vinil vermelho transparente.',
                'user_id' => 1
            ],
            [
                'titulo' => 'Sobrevivendo no Inferno',
                'artista_diretor' => 'Racionais MC\'s',
                'empresa_produtora' => 'Cosa Nostra',
                'preco' => 320.00,
                'category_id' => 4, // Hip Hop
                'media_format_id' => 1, // Vinil
                'tipo_midia' => 'Música',
                'descricao' => 'Reedição de luxo. Item fundamental do Rap Nacional.',
                'user_id' => 1
            ],
            [
                'titulo' => 'Santa Madre Cassino',
                'artista_diretor' => 'Matanza',
                'empresa_produtora' => 'Deckdisc',
                'preco' => 45.00,
                'category_id' => 6, // Rock Nacional
                'media_format_id' => 2, // CD
                'tipo_midia' => 'Música',
                'descricao' => 'CD em excelente estado. Country-Core puro.',
                'user_id' => 1
            ],

            // --- FILMES (Categorias 11-20 | Formatos 4-6) ---
            [
                'titulo' => 'O Auto da Compadecida',
                'artista_diretor' => 'Guel Arraes',
                'empresa_produtora' => 'Globo Filmes',
                'elenco_detalhes' => 'Selton Mello, Matheus Nachtergaele',
                'preco' => 40.00,
                'category_id' => 15, // Clássicos do Cinema
                'media_format_id' => 4, // DVD
                'tipo_midia' => 'Filme',
                'descricao' => 'DVD Edição Especial. Baseado na obra de Ariano Suassuna.',
                'user_id' => 1
            ],
            [
                'titulo' => 'Akira',
                'artista_diretor' => 'Katsuhiro Otomo',
                'empresa_produtora' => 'TMS Entertainment',
                'elenco_detalhes' => 'Mitsuo Iwata, Nozomu Sasaki',
                'preco' => 90.00,
                'category_id' => 19, // Animes Clássicos
                'media_format_id' => 5, // Blu-ray
                'tipo_midia' => 'Filme',
                'descricao' => 'Remasterizado em alta definição. Áudio original em Japonês.',
                'user_id' => 1
            ],
            [
                'titulo' => 'Evil Dead (Uma Noite Alucinante)',
                'artista_diretor' => 'Sam Raimi',
                'empresa_produtora' => 'Renaissance Pictures',
                'elenco_detalhes' => 'Bruce Campbell',
                'preco' => 55.00,
                'category_id' => 12, // Terror
                'media_format_id' => 4, // DVD
                'tipo_midia' => 'Filme',
                'descricao' => 'Capa Necronomicon de borracha. Raro para colecionadores.',
                'user_id' => 1
            ],

            // --- GAMES (Categorias 21-28 | Formatos 7-11) ---
            [
                'titulo' => 'Silent Hill',
                'artista_diretor' => 'Keiichiro Toyama',
                'empresa_produtora' => 'Konami',
                'preco' => 600.00,
                'category_id' => 23, // Survival Horror Games
                'media_format_id' => 8, // CD-ROM (PS1)
                'tipo_midia' => 'Jogo',
                'descricao' => 'Versão Black Label original. Disco com marcas leves de uso.',
                'user_id' => 1
            ],
            [
                'titulo' => 'Pokémon Yellow',
                'artista_diretor' => 'Satoshi Tajiri',
                'empresa_produtora' => 'Nintendo / Game Freak',
                'preco' => 450.00,
                'category_id' => 21, // Retro Gaming
                'media_format_id' => 7, // Cartucho
                'tipo_midia' => 'Jogo',
                'descricao' => 'Cartucho original GBC. Label preservada.',
                'user_id' => 1
            ],
            [
                'titulo' => 'The Legend of Zelda: Ocarina of Time',
                'artista_diretor' => 'Shigeru Miyamoto',
                'empresa_produtora' => 'Nintendo',
                'preco' => 380.00,
                'category_id' => 22, // RPGs & Fantasia
                'media_format_id' => 7, // Cartucho
                'tipo_midia' => 'Jogo',
                'descricao' => 'Cartucho cinza de N64. Bateria de save nova.',
                'user_id' => 1
            ],
        ];

        foreach ($itens as $item) {
            Item::create($item);
        }
    }
}