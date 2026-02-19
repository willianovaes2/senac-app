<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avaliacoes_indicadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained('aluno')->onDelete('cascade');
            $table->foreignId('indicador_id')->constrained('indicadores')->onDelete('cascade');
            $table->foreignId('aula_id')->constrained('aulas')->onDelete('cascade')->nullable();
            $table->enum('conceito', ['Atendido', 'Não Atendido'])->nullable();
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avaliacoes_indicadores');
    }
};