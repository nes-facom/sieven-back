<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Atividade;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ParticipacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();
        $atividade = Atividade::factory()->create();

        return [
            'user_id' => $user->id,
            'atividade_id' => $atividade->id,
            'situacao' => 'Inscrito',
            'created_at' => '2023-05-04 08:00:00',
            'updated_at' => '2023-05-04 08:00:00'
        ];
    }
}
