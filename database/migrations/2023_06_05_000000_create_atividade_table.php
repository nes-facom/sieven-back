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
            $table->timestamp('horario_inicio');
            $table->timestamp('horario_encerramento');
            $table->string('palestrante', 255)->nullable();
            $table->enum('modalidade', ['Presencial', 'Remoto', 'Híbrido'])->nullable();
            $table->bigInteger('quantidade_vagas')->nullable();
            $table->text('requisitos')->nullable();
            $table->text('acessibilidade')->nullable();            
            $table->enum('situacao', ['Ativa', 'Cancelada', 'Concluída'])->default('Ativa');
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
