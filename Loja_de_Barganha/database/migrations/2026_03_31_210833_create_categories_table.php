<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Se a tabela não existe, usamos CREATE
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->string('icone')->default('bi-tag'); 
            $table->enum('tipo_midia', ['Música', 'Jogo', 'Filme', 'Outro'])->default('Outro');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
