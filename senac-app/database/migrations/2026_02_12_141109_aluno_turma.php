<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('aluno_turma', function (Blueprint $table) {
            $table->unsignedInteger('turma_id');
            $table->unsignedInteger('aluno_id');
            $table->foreign('turma_id')->references('id')->on('turma')->onDelete('cascade');
            $table->foreign('aluno_id')->references('id')->on('aluno')->onDelete('cascade');
            $table->primary(['turma_id', 'aluno_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('aluno_turma');
    }
};