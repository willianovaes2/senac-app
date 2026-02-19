<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('docente_curso', function (Blueprint $table) {
            $table->id();

            $table->foreignId('docente_id')
                  ->constrained('docente')
                  ->onDelete('cascade');

            $table->foreignId('curso_id')
                  ->constrained('curso')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('docente_curso');
    }
};