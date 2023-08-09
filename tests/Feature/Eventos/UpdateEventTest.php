<?php

namespace Tests\Feature\Eventos;

use App\Models\User;
use App\Models\Evento;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateEventTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_event_screen_can_be_rendered()
    {
        $response = $this->get('/eventos');
        $response->assertStatus(200);
    }

    public function test_update_event()
    {
        $evento = Evento::factory()->create();
        $response = $this->put('/eventos/' . $evento->id, [
            'nome' => 'Updated Event',
        ]);
        $response->assertStatus(200);
    }

    public function test_update_event_invalid_duration_date()
    {
        $evento = Evento::factory()->create();
        $response = $this->put('/eventos/' . $evento->id, [
            'data_inicial' => '2023-05-10 08:00:00',
            'data_final' => '2023-05-10 07:00:00',
        ]);
        $response->assertStatus(400);
    }

    public function test_update_event_invalid_register_date()
    {
        $evento = Evento::factory()->create();
        $response = $this->put('/eventos/' . $evento->id, [
            'updated_at' => '2023-05-04 06:00:00',
        ]);
        $response->assertStatus(400);
    }

    public function test_update_event_invalid_attribute_created_at_update()
    {
        $evento = Evento::factory()->create();
        $response = $this->put('/eventos/' . $evento->id, [
            'created_at' => '2023-05-04 14:00:00',
        ]);
        $response->assertStatus(400);
    }

    public function test_update_event_invalid_attribute_created_by_user_update()
    {
        $evento = Evento::factory()->create();
        $usuario = User::factory()->create();

        $response = $this->put('/eventos/' . $evento->id, [
            'created_by_user' => $usuario->id,
        ]);
        $response->assertStatus(400);
    }

    public function test_create_new_event_with_wrong_situacao()
    {
        $evento = Evento::factory()->create();

        try {
            $response = $this->put('/eventos/' . $evento->id, [
                'situacao' => 'Situacao Inválida',
            ]);

            $this->fail('Modalidade inválida');
        } 
        
        catch (\Exception $e) 
        {
            $this->assertInstanceOf(\Exception::class, $e);
        }
    }
    
    public function test_create_new_event_with_wrong_categoria()
    {
        $evento = Evento::factory()->create();

        try {
            $response = $this->put('/eventos/' . $evento->id, [
                'categoria' => 'Categoria Invalida',
            ]);

            $this->fail('Modalidade inválida');
        } 
        
        catch (\Exception $e) 
        {
            $this->assertInstanceOf(\Exception::class, $e);
        }
    }

    public function test_create_new_event_with_wrong_modalidade()
    {        
        $evento = Evento::factory()->create();

        try {
            $response = $this->put('/eventos/' . $evento->id, [
                'modalidade' => 'Modalidade Inválida'
            ]);

            $this->fail('Modalidade inválida');
        } 
        
        catch (\Exception $e) 
        {
            $this->assertInstanceOf(\Exception::class, $e);
        }
    }

}