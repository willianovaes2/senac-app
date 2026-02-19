<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aluno_turma', function (Blueprint $table) {
            $table->id();

            $table->foreignId('aluno_id')
                  ->constrained('aluno')
                  ->onDelete('cascade');

            $table->foreignId('turma_id')
                  ->constrained('turma')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aluno_turma');
    }
};