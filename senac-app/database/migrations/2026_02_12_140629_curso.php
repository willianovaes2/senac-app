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
        //criando a tabela
        schema::create('curso', function (Blueprint $table) {
            $table->increments('id');
            $table->longtext('nome');
            $table->longtext('tipo');
            $table->integer('cargaHoraria');
            $table->decimal('preco', 10, 2);
            $table->integer('vagas');
            $table->integer('bolsas');
            $table->longtext('situacao');
            $table->text('sigla');
            $table->json('dias')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //caso a tabela exista
        schema::dropIfExists('curso');
    }
};