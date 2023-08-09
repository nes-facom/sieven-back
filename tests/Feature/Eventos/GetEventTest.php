<?php

namespace Tests\Feature\Eventos;

use App\Models\User;
use App\Models\Evento;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetEventTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_event_screen_can_be_rendered()
    {
        $response = $this->get('/eventos');
        $response->assertStatus(200);
    }

    public function test_get_event_by_id()
    {
        $evento = Evento::factory()->create();
        $response = $this->get('/eventos/'.$evento->id);
        $response->assertStatus(200);
        
        $response_json = $response->json();
        $this->assertEquals($evento->id, $response_json['id']);
    }

    public function test_get_event_not_registered()
    {
        $response = $this->get('/eventos/100');
        $response->assertStatus(200);

        $event = $response->json();
        $this->assertEquals([], $event);
    }

    public function test_get_active_events()
    {
        $evento = Evento::factory()->create();
        $evento->situacao = 'Aprovado';
        $evento->save();

        $response = $this->get('/eventosAtivos');
        $response->assertStatus(200);

        $response->assertViewIs('eventos.index');
    }

    public function test_get_not_active_events()
    {
        $evento = Evento::factory()->create();
        $response = $this->get('/eventosAtivos');
        $response->assertStatus(404);
    }

    public function test_get_solicited_events()
    {
        $evento = Evento::factory()->create();

        $response = $this->get('/eventosSolicitados');
        $response->assertStatus(200);

        $response->assertViewIs('eventos.index');
    }

    public function test_get_not_solicited_events()
    {
        $evento = Evento::factory()->create();
        $evento->situacao = 'Aprovado';
        $evento->save();

        $response = $this->get('/eventosSolicitados');
        $response->assertStatus(404);
    }

    public function test_get_event_by_user()
    {
        $evento = Evento::factory()->create();

        $response = $this->get('/eventos/eventosByUser/' . $evento->created_by_user);
        $response->assertStatus(200);

        $response->assertViewIs('eventos.index');
    }

    public function test_get_event_by_wrong_user()
    {
        $evento = Evento::factory()->create();

        $response = $this->get('/eventos/eventosByUser/' . 100);
        $response->assertStatus(404);
    }

    public function test_get_active_event_by_user()
    {
        $evento = Evento::factory()->create();
        $evento->situacao = 'Aprovado';
        $evento->save();

        $response = $this->get('/eventos/eventosAtivosByUser/' . $evento->created_by_user);
        $response->assertStatus(200);

        $response->assertViewIs('eventos.index');
    }
    
}