<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('docente_curso', function (Blueprint $table) {
            $table->unsignedInteger('docente_id');
            $table->unsignedInteger('curso_id');
            $table->foreign('docente_id')->references('id')->on('docente')->onDelete('cascade');
            $table->foreign('curso_id')->references('id')->on('curso')->onDelete('cascade');
            $table->primary(['docente_id', 'curso_id']);
        });
    }

    public function down() 
    {
        Schema::dropIfExists('docente_curso');
    }
};
