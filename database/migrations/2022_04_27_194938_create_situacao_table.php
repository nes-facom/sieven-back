<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSituacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('situacao', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
        });

        DB::table('situacao')->insert([
            ['nome' => 'ATIVO'], /** id - 1 */
            ['nome' => 'INATIVO'],
            ['nome' => 'APROVAÇÃO SOLICITADA'],
            ['nome' => 'APROVADO'],
            ['nome' => 'ENCERRADO'],
            ['nome' => 'PRESENTE'],
            ['nome' => 'FALTANTE'],
            ['nome' => 'NÃO OCORREU']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('situacao');
    }
}
