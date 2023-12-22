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
        Schema::create('jogadores', function (Blueprint $table) {
            $table->id(); // Cria uma coluna de identificação (normalmente uma chave primária).
            $table->string('nome'); // Cria uma coluna para armazenar o nome do jogador como uma string.
            $table->integer('nivel'); // Cria uma coluna para armazenar o nível do jogador como um número inteiro.
            $table->boolean('goleiro')->default(false); // Cria uma coluna para indicar se o jogador é goleiro ou não, com um valor padrão de falso.
            $table->boolean('confirmado')->default(false); // Cria uma coluna para indicar se o jogador confirmou presença, com um valor padrão de falso.
            $table->timestamps(); // Cria duas colunas para armazenar automaticamente a data e a hora de criação e atualização de cada registro.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jogadores');
    }
};
