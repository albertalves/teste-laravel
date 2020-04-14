<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nome');
            $table->string('cpf', 14);
            $table->string('cep', 20);
            $table->string('uf', 45);
            $table->text('cidade');
            $table->text('bairro');
            $table->text('logradouro');
            $table->text('numero');
            $table->text('complemento');
            $table->string('telefone', 45);
            $table->string('telefone_2', 45);
            $table->string('nacionalidade', 45);
            $table->date('data_nascimento');
            $table->unsignedBigInteger('grupo_id');
            $table->foreign('grupo_id')->references('id')->on('grupos'); //pessoas_grupo_id_foreign
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
}
