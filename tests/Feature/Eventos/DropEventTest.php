<?php

namespace Tests\Feature\Eventos;

use App\Models\User;
use App\Models\Evento;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DropEventTest extends TestCase
{
    use RefreshDatabase;

    public function test_drop_event_screen_can_be_rendered()
    {
        $response = $this->get('/eventos');
        $response->assertStatus(200);
    }

    public function test_drop_event()
    {
        $evento = Evento::factory()->create();
        $response = $this->delete('/eventos/' . $evento->id);
        $response->assertStatus(200);
    }

    public function test_drop_event_not_registered()
    {
        $response = $this->delete('/eventos/100');
        $response->assertStatus(404);
    }
}