<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VwEventoAtividade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE VIEW evento_atividade_view AS
        SELECT
            e.id AS evento_id,
            e.nome AS nome_evento,
            e.data_inicial AS data_inicial_evento,
            e.data_final AS data_final_evento,
            e.descricao AS descricao_evento,
            e.local AS local_evento,
            a.id AS atividade_id,
            a.titulo AS titulo_atividade,
            a.local AS local_atividade,
            m.id AS modalidade_id,
            m.nome_modalidade AS nome_modalidade,
            a.horario_inicio AS data_inicial_atividade,
            a.horario_encerramento AS data_final_atividade
        FROM
            evento e
        INNER JOIN
            atividade a ON e.id = a.evento_id
        INNER JOIN
            modalidade m ON a.id_modalidade = m.id;"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
