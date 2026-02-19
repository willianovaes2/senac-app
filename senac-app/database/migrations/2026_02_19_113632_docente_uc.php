<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('docente_uc', function (Blueprint $table) {
            $table->id();

            $table->foreignId('docente_id')
                  ->constrained('docente')
                  ->onDelete('cascade');

            $table->foreignId('uc_id')
                  ->constrained('uc')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('docente_uc');
    }
};