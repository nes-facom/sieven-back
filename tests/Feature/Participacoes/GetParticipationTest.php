<?php

namespace Tests\Feature\Eventos;

use App\Models\User;
use App\Models\Atividade;
use App\Models\Participacao;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetParticipationTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_participation_screen_can_be_rendered()
    {
        $response = $this->get('/participacoes');

        $response->assertStatus(200);
    }

    public function test_get_participation_by_id()
    {
        $participacao = Participacao::factory()->create();
        $response = $this->get('/participacoes/' . $participacao->id);
        $response->assertStatus(200);
        
        $response_json = $response->json();
        $this->assertEquals($participacao->id, $response_json['id']);
    }

    public function test_get_participation_not_registered()
    {
        $response = $this->get('/participacoes/' . 100);
        $response->assertStatus(200);

        $response_json = $response->json();
        $this->assertEquals([], $response_json);
    }

    public function test_get_participation_by_activity_id()
    {
        $participacao = Participacao::factory()->create();
        $response = $this->get('/participacoes/participacoesByAtividade/' . $participacao->atividade_id);
        $response->assertStatus(200);

        $response->assertViewIs('participacoes.index');
    }

    public function test_get_participation_by_wrong_activity_id()
    {
        $participacao = Participacao::factory()->create();
        $response = $this->get('/participacoes/participacoesByAtividade/' . 100);
        $response->assertStatus(404);
    }

    public function test_get_participation_by_user_id()
    {
        $participacao = Participacao::factory()->create();
        $response = $this->get('/participacoes/participacoesByUser/' . $participacao->user_id);
        $response->assertStatus(200);
        
        $response->assertViewIs('participacoes.index');
    }

    public function test_get_participation_by_wrong_user_id()
    {
        $participacao = Participacao::factory()->create();
        $response = $this->get('/participacoes/participacoesByUser/' . 100);
        $response->assertStatus(404);
    }
}