<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscricaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscricaos', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->integer('atividade_id');
            $table->string('nome');
            $table->string('cpf')->unique();
            $table->string('email')->unique();
            $table->string('telefone');
            $table->boolean('checkin');
            $table->timestamps();

            $table->foreign('atividade_id')->references('id')->on('atividade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscricaos');
    }
}
