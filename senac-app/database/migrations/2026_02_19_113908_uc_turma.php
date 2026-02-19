<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('uc_turma', function (Blueprint $table) {
            $table->id();

            $table->foreignId('uc_id')
                  ->constrained('uc') // nome real da tabela UC
                  ->cascadeOnDelete();

            $table->foreignId('turma_id')
                  ->constrained('turma') // nome real da tabela turma
                  ->cascadeOnDelete();

            $table->date('data_inicio');
            $table->date('data_fim');

            $table->enum('status', [
                'prevista',
                'em_andamento',
                'concluida',
                'cancelada'
            ])->default('prevista');

            $table->timestamps();

            // impede mesma UC duplicada na mesma turma
            $table->unique(['uc_id', 'turma_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uc_turma');
    }
};