<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('avaliacao_parcial', function (Blueprint $table) {
            $table->id();

            $table->foreignId('aula_id')
                ->constrained('aula')
                ->onDelete('cascade');

            $table->foreignId('aluno_id')
                ->constrained('aluno')
                ->onDelete('cascade');

            $table->string('conceito_final')->nullable();

            $table->timestamps();

            $table->unique(['aula_id', 'aluno_id']);
        });
    }
};