<?php

namespace Tests\Feature\Eventos;

use App\Models\User;
use App\Models\Atividade;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateParticipationTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_participation_screen_can_be_rendered()
    {
        $response = $this->get('/participacoes');

        $response->assertStatus(200);
    }

    public function test_create_new_participation()
    {
        $user = User::factory()->create();
        $atividade = Atividade::factory()->create();

        $response = $this->post('/participacoes', [
            'user_id' => $user->id,
            'atividade_id' => $atividade->id,
            'situacao' => 'Inscrito',
            'created_at' => '2023-05-10 08:00:00',
            'updated_at' => '2023-05-10 08:00:00'
        ]);

        $response->assertStatus(200);
    }

    public function test_create_new_participation_invalid_register_date()
    {
        $user = User::factory()->create();
        $atividade = Atividade::factory()->create();

        $response = $this->post('/participacoes', [
            'user_id' => $user->id,
            'atividade_id' => $atividade->id,
            'situacao' => 'Inscrito',
            'created_at' => '2023-05-10 08:00:00',
            'updated_at' => '2023-05-10 05:00:00'
        ]);

        $response->assertStatus(400);
    }

    public function test_create_new_participation_invalid_situacao()
    {
        $user = User::factory()->create();
        $atividade = Atividade::factory()->create();

        try 
        {
            $response = $this->post('/participacoes', [
                'user_id' => $user->id,
                'atividade_id' => $atividade->id,
                'situacao' => 'Situação Inválida',
                'created_at' => '2023-05-10 08:00:00',
                'updated_at' => '2023-05-10 08:00:00'
            ]);

            $this->fail('Modalidade inválida');
        } 
        
        catch (\Exception $e) 
        {
            $this->assertInstanceOf(\Exception::class, $e);
        }
    }

    public function test_create_new_participation_wrong_situacao()
    {
        $user = User::factory()->create();
        $atividade = Atividade::factory()->situacao_concluida()->create();

        $response = $this->post('/participacoes', [
            'user_id' => $user->id,
            'atividade_id' => $atividade->id,
            'situacao' => 'Inscrito',
            'created_at' => '2023-05-10 08:00:00',
            'updated_at' => '2023-05-10 05:00:00'
        ]);

        $response->assertStatus(400);
    }

}