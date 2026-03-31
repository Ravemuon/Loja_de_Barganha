<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            
            // Campos Flexíveis (Opcionais dependendo da mídia)
            // Para Música: Artista | Para Filme: Diretor | Para Jogo: Desenvolvedor
            $table->string('artista_diretor')->nullable();
            
            // Para Música: Gravadora | Para Filme: Estúdio | Para Jogo: Empresa/Publisher
            $table->string('empresa_produtora')->nullable();
            
            // Para Música: Faixas | Para Filme: Elenco | Para Jogo: Requisitos/Expansão
            $table->text('elenco_detalhes')->nullable();
            
            // Estado de conservação ou curiosidades do item
            $table->text('descricao')->nullable();
            
            $table->decimal('preco', 8, 2);
            $table->string('tipo_midia'); // Ex: Música, Jogo, Filme
            $table->string('capa')->nullable();
            
            // Relacionamentos
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('media_format_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};