<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aula_aluno', function (Blueprint $table) {
            $table->id();

            $table->foreignId('aula_id')
                ->constrained('aulas')
                ->cascadeOnDelete();

            $table->foreignId('aluno_id')
                ->constrained('aluno') // ← aqui
                ->cascadeOnDelete();

            $table->boolean('presenca')->default(false);

            $table->timestamps();

            $table->unique(['aula_id', 'aluno_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aula_aluno');
    }
};