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
        //
        schema::create('aluno', function(Blueprint $table){
            $table->increments('id');
            $table->longtext('nomeAluno');
            $table->text('intencao');
            $table->char('ra', 10)->unique();
            $table->string('cpf', 11)->unique();
            $table->date('dataNascimento');
            $table->text('telefone');
            $table->longtext('endereco');
            $table->longtext('emailAluno');
            $table->longtext('senhaAluno');
            $table->date('dataMatricula');
            $table->enum('tipo', ['bolsista', 'pagante'])->default('pagante');
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
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
        //excluir caso exista
        schema::dropIfExists('aluno');

    }
};