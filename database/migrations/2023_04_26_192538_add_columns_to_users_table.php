<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cpf')->unique()->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('foto_perfil')->nullable();
            $table->boolean('membro_ufms')->default(false);
            $table->boolean('administrador')->default(false);
            $table->integer('situacao_id')->default(1);

            $table->foreign('situacao_id')->references('id')->on('situacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
