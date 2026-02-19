<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('docente_turma', function (Blueprint $table) {
            $table->id();

            $table->foreignId('docente_id')
                  ->constrained('docente')
                  ->onDelete('cascade');

            $table->foreignId('turma_id')
                  ->constrained('turma')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('docente_turma');
    }
};