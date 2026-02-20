<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aula_aluno', function (Blueprint $table) {
            $table->text('observacao')->nullable();
        });

        Schema::table('aulas', function (Blueprint $table) {
            $table->text('descricao')->nullable();
        });
    }

    public function down(): void
    {
        // Remove colunas caso precise reverter
        Schema::table('aula_aluno', function (Blueprint $table) {
            $table->dropColumn('observacao');
        });

        Schema::table('aulas', function (Blueprint $table) {
            $table->dropColumn('descricao');
        });
    }
};
