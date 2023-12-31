<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->text('local')->nullable();
            $table->timestamp('data_inicial')->nullable();
            $table->timestamp('data_final')->nullable();
            $table->text('imagem')->nullable();
            $table->timestamps();
            $table->integer('created_by_user');
            $table->enum('situacao', ['Em Aprovação', 'Aprovado', 'Não Aprovado', 'Cancelado', 'Concluído'])->default('Em Aprovação');

            $table->foreign('created_by_user')->references('id')->on('users');
        });       
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evento');
    }
}
