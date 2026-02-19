<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('curso_uc', function (Blueprint $table) {
            $table->id();

            $table->foreignId('curso_id')
                ->constrained('curso')
                ->onDelete('cascade');
            $table->foreignId('uc_id')
                ->constrained('uc')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curso_uc');
    }
};