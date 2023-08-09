<?php

namespace Tests\Feature\Atividades;

use App\Models\User;
use App\Models\Atividade;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DropActivityTest extends TestCase
{
    use RefreshDatabase;

    public function test_drop_activity_screen_can_be_rendered()
    {
        $response = $this->get('/atividades');
        $response->assertStatus(200);
    }

    public function test_drop_activity()
    {
        $atividade = Atividade::factory()->create();
        $response = $this->delete('/atividades/' . $atividade->id);
        $response->assertStatus(200);
    }

    public function test_drop_activity_not_registered()
    {
        $response = $this->delete('/atividades/100');
        $response->assertStatus(404);
    }
}