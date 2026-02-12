<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aula_docente', function (Blueprint $table) {
            $table->id();

            $table->foreignId('aula_id')
                ->constrained('aulas')
                ->onDelete('cascade');

            $table->foreignId('docente_id')
                ->constrained('docente')
                ->onDelete('cascade');

            $table->timestamps();

            $table->unique(['aula_id', 'docente_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aula_docente');
    }
};