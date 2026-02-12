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
        schema::create('relatorio', function(Blueprint $table){
            $table->increments('id');
            $table->longtext('feedbackAluno');
            $table->date('dataEnvio');
            $table->enum('resultado', ['aprovado', 'reprovado'])->default('aprovado');
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
        //apagando caso exista
        schema::dropIfExists('relatorio');
    }
};