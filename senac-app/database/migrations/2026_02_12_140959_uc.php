<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //criando colunas
        schema::create('uc', function (Blueprint $table) {
            $table->increments('id');
            $table->text('codigoUc');
            $table->longtext('nome');
            $table->integer('cargaHoraria');
            $table->decimal('presencaMinima', 10, 2);
            $table->longtext('descricao');
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
            $table->unsignedInteger('cursoCodigo');
            $table->timestamps();

            $table->foreign('cursoCodigo')->references('id')->on('curso')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //excluir caso exista
        schema::dropIfExists('uc');
    }
};