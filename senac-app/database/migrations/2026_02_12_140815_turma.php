<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('turma', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('curso_id');
            $table->foreign('curso_id')->references('id')->on('curso')->onDelete('cascade');

            $table->text('codigoTurma');
            $table->date('dataInicio');
            $table->date('dataFim');
            $table->enum('turno', ['M', 'T', 'N'])->default('M');
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
            $table->integer('horasPorDia');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('turma');
    }
};