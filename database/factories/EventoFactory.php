<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();
        
        return [
            'nome' => 'Test Event',
            'descricao' => 'Test Event',
            'local' => 'UFMS - FACOM',
            'categoria' => 'Científico',
            'data_inicial' => '2023-05-10 08:00:00',
            'data_final'  => '2023-05-14 20:00:00',
            'created_by_user' => $user->id,
            'situacao' => 'Em Aprovação',
            'created_at' => '2023-05-04 08:00:00',
            'updated_at' => '2023-05-04 08:00:00'
        ];
    }
}
