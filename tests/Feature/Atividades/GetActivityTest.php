<?php

namespace Tests\Feature\Atividades;

use App\Models\User;
use App\Models\Atividade;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetActivityTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_activity_screen_can_be_rendered()
    {
        $response = $this->get('/atividades');
        $response->assertStatus(200);
    }

    public function test_get_activity_by_id()
    {
        $atividade = Atividade::factory()->create();
        $response = $this->get('/atividades/'.$atividade->id);
        $response->assertStatus(200);
        
        $response_json = $response->json();
        $this->assertEquals($atividade->id, $response_json['id']);
    }

    public function test_get_activity_not_registered()
    {
        $response = $this->get('/atividades/100');
        $response->assertStatus(200);

        $response_json = $response->json();
        $this->assertEquals([], $response_json);
    }

    public function test_get_activity_by_not_registered_event()
    {
        $response = $this->get('/atividades/atividadesByEvent/' . 100);
        $response->assertStatus(404);
    }
    
}