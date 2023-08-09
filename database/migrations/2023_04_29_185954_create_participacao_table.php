<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participacao', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('atividade_id');
            $table->enum('situacao', ['Inscrito', 'Cancelado', 'Ausente', 'Presente'])->default('Inscrito');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('participacao');
    }
}
