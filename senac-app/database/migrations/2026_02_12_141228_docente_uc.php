<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('docente_uc', function (Blueprint $table) {
            $table->unsignedInteger('docente_id');
            $table->unsignedInteger('uc_id');
            $table->foreign('docente_id')->references('id')->on('docente')->onDelete('cascade');
            $table->foreign('uc_id')->references('id')->on('uc')->onDelete('cascade');
            $table->primary(['docente_id', 'uc_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('docente_uc');
    }
};