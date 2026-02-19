<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aluno_indicador', function (Blueprint $table) {
            $table->id();

            $table->foreignId('aula_id')->constrained('aulas')->cascadeOnDelete();
            $table->foreignId('aluno_id')->constrained('aluno')->cascadeOnDelete();
            $table->foreignId('indicador_id')->constrained('indicadores')->cascadeOnDelete();

            $table->string('conceito')->nullable();

            $table->timestamps();

            $table->unique(['aula_id', 'aluno_id', 'indicador_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aluno_indicador');
    }
};