<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aula_turma', function (Blueprint $table) {
            $table->id();

            $table->foreignId('aula_id')
                ->constrained('aulas')
                ->onDelete('cascade');

            $table->foreignId('turma_id')
                ->constrained('turma')
                ->onDelete('cascade');

            $table->timestamps();

            $table->unique(['aula_id', 'turma_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aula_turma');
    }
};