<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1️⃣ Adiciona observação individual na pivot aula_aluno
        Schema::table('aula_aluno', function (Blueprint $table) {
            $table->text('observacao')->nullable()->after('presenca');
        });

        // 2️⃣ Adiciona observação geral na tabela aulas
        Schema::table('aulas', function (Blueprint $table) {
            $table->text('descricao')->nullable()->after('status');
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