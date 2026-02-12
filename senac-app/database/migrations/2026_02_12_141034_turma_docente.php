<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('turma_docente', function (Blueprint $table) {
            $table->unsignedInteger('turma_id');
            $table->unsignedInteger('docente_id');
            $table->foreign('turma_id')->references('id')->on('turma')->onDelete('cascade');
            $table->foreign('docente_id')->references('id')->on('docente')->onDelete('cascade');
            $table->primary(['turma_id', 'docente_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('turma_docente');
    }
};