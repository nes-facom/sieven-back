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
            $table->string('titulo')->nullable();
            $table->string('descricao')->nullable();
            $table->string('local')->nullable();
            $table->timestamp('horario_inicio');
            $table->timestamp('horario_encerramento');
            $table->foreignId('id_modalidade')->nullable()->references('id')->on('modalidade');
            $table->bigInteger('quantidade_vagas')->nullable();
            $table->timestamps();

            $table->foreign('evento_id')->references('id')->on('evento');
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
