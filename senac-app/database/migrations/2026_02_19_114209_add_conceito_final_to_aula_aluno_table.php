<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('aula_aluno', function (Blueprint $table) {
            $table->string('conceito_final')->nullable()->after('presenca');
        });
    }

    public function down()
    {
        Schema::table('aula_aluno', function (Blueprint $table) {
            $table->dropColumn('conceito_final');
        });
    }
};