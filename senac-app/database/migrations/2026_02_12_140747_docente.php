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
        //criando as colunas da tabela
        schema::create('docente', function(Blueprint $table){
            $table->increments('id');
            $table->longtext('nomeDocente');
            $table->text('cpf', 11)->unique();
            $table->date('dataNascimento');
            $table->text('telefone');
            $table->longtext('emailDocente');
            $table->longtext('formacao');
            $table->longtext('especializacao');
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
            $table->date('dataCadastro');
            $table->integer('cargaHoraria');
            $table->json('turno')->nullable();
            $table->longtext('senhaDocente');
            $table->longtext('endereco');
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
        //excluir caso a tabela ja exista
        schema::dropIfExists('docente');
    }
};