<?php

namespace Tests\Feature\Eventos;

use App\Models\User;
use App\Models\Atividade;
use App\Models\Participacao;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DropParticipationTest extends TestCase
{
    use RefreshDatabase;

    public function test_drop_participation_screen_can_be_rendered()
    {
        $response = $this->get('/participacoes');

        $response->assertStatus(200);
    }

    public function test_drop_participation()
    {
        $participacao = Participacao::factory()->create();
        $response = $this->delete('/participacoes/' . $participacao->id);
        $response->assertStatus(200);
    }

    public function test_drop_participation_not_registered()
    {
        $response = $this->delete('/participacoes/100');
        $response->assertStatus(404);
    }

}