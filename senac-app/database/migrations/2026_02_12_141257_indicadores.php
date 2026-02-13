<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('indicadores', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao');
            $table->timestamps();
        });

        Schema::create('indicador_uc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indicador_id')->constrained('indicadores')->cascadeOnDelete();
            $table->foreignId('uc_id')->constrained('uc')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indicador_uc');
        Schema::dropIfExists('indicadores');
    }
};