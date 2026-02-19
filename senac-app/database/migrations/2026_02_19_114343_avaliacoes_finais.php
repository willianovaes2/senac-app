<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avaliacoes_finais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained('aluno')->onDelete('cascade');
            $table->foreignId('uc_id')->constrained('uc')->onDelete('cascade');
            $table->enum('conceito_final', ['Atendido', 'Não Atendido'])->nullable();
            $table->text('observacao')->nullable();
            $table->timestamps();

            // Garante que um aluno só tenha 1 avaliação final por UC
            $table->unique(['aluno_id', 'uc_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avaliacoes_finais');
    }
};