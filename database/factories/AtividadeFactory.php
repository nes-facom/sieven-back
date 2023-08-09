<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Evento;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AtividadeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $evento = Evento::factory()->create();

        return [
            'evento_id' => $evento->id,
            'nome' => 'Event Test',
            'descricao' => 'Test Description',
            'endereco' => 'Test Local',
            'modalidade' => 'Presencial',
            'quantidade_vagas' => 100,
            'horario_inicio' => '2023-05-10 08:00:00',
            'horario_encerramento' => '2023-05-10 10:00:00',
            'requisitos' => 'Não há requisitos',
            'acessibilidade' => 'Não há acessibilidade',
            'link_atividade' => Null,
            'situacao' => 'Ativa',
            'created_at' => '2023-05-05 08:00:00',
            'updated_at' => '2023-05-05 08:00:00',
        ];
    }

    public function situacao_concluida()
    {
        return $this->state(function (array $attributes) 
        {
            return [
                'situacao' => 'Concluída',
            ];
        });
    }
}