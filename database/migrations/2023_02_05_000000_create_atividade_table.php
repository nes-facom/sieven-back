<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividade', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('evento_id');
            $table->string('nome');
            $table->string('descricao')->nullable();
            $table->string('local')->nullable();
            $table->foreignId('id_categoria')->references('id')->on('categoria');
            $table->foreignId('id_tipo')->references('id')->on('tipo');
            $table->timestamp('horario_inicio');
            $table->timestamp('horario_encerramento');
            $table->bigInteger('quantidade_vagas')->nullable();
            $table->foreignId('id_modalidade')->references('id')->on('modalidade');
            $table->timestamps();

            $table->foreign('evento_id')->references('id')->on('evento')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atividade');
    }
}
