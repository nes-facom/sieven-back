<?php

namespace Tests\Feature\Eventos;

use App\Models\User;
use App\Models\Evento;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateEventTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_event_screen_can_be_rendered()
    {
        $response = $this->get('/eventos');

        $response->assertStatus(200);
    }

    public function test_create_new_event()
    {
        $user = User::factory()->create();

        $response = $this->post('/eventos', [
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
        ]);

        $response->assertStatus(200);
    }

    public function test_create_new_event_invalid_duration_date()
    {
        $user = User::factory()->create();

        $response = $this->post('/eventos', [
            'nome' => 'Test Event',
            'descricao' => 'Test Event',
            'local' => 'UFMS - FACOM',
            'categoria' => 'Científico',
            'data_inicial' => '2023-05-10 08:00:00',
            'data_final'  => '2023-05-10 05:00:00',
            'created_by_user' => $user->id,
            'situacao' => 'Em Aprovação',
            'created_at' => '2023-05-04 08:00:00',
            'updated_at' => '2023-05-04 08:00:00'
        ]);

        $response->assertStatus(400);
    }

    public function test_create_new_event_invalid_register_date()
    {
        $user = User::factory()->create();

        $response = $this->post('/eventos', [
            'nome' => 'Test Event',
            'descricao' => 'Test Event',
            'local' => 'UFMS - FACOM',
            'categoria' => 'Científico',
            'data_inicial' => '2023-05-10 08:00:00',
            'data_final'  => '2023-05-14 20:00:00',
            'created_by_user' => $user->id,
            'situacao' => 'Em Aprovação',
            'created_at' => '2023-05-04 08:00:00',
            'updated_at' => '2023-05-04 05:00:00'
        ]);

        $response->assertStatus(400);
    }

    public function test_create_new_event_without_approve()
    {
        $user = User::factory()->create();

        $response = $this->post('/eventos', [
            'nome' => 'Test Event',
            'descricao' => 'Test Event',
            'local' => 'UFMS - FACOM',
            'categoria' => 'Científico',
            'data_inicial' => '2023-05-10 08:00:00',
            'data_final'  => '2023-05-14 20:00:00',
            'created_by_user' => $user->id,
            'situacao' => 'Aprovado',
            'created_at' => '2023-05-04 08:00:00',
            'updated_at' => '2023-05-04 08:00:00'
        ]);

        $response->assertStatus(400);
    }

    public function test_create_new_event_with_wrong_situacao()
    {
        $user = User::factory()->create();
        
        try {
            $response = $this->post('/eventos', [
                'nome' => 'Test Event',
                'descricao' => 'Test Event',
                'local' => 'UFMS - FACOM',
                'categoria' => 'Científico',
                'data_inicial' => '2023-05-10 08:00:00',
                'data_final'  => '2023-05-14 20:00:00',
                'created_by_user' => $user->id,
                'situacao' => 'Para Aprovar',
                'created_at' => '2023-05-04 08:00:00',
                'updated_at' => '2023-05-04 08:00:00'
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
        $user = User::factory()->create();

        try {
            $response = $this->post('/eventos', [
                'nome' => 'Test Event',
                'descricao' => 'Test Event',
                'local' => 'UFMS - FACOM',
                'categoria' => 'Categoria',
                'data_inicial' => '2023-05-10 08:00:00',
                'data_final'  => '2023-05-14 20:00:00',
                'created_by_user' => $user->id,
                'situacao' => 'Em Aprovação',
                'created_at' => '2023-05-04 08:00:00',
                'updated_at' => '2023-05-04 08:00:00'
            ]);

            $this->fail('Modalidade inválida');
        } 
        
        catch (\Exception $e) 
        {
            $this->assertInstanceOf(\Exception::class, $e);
        }
    }

    public function test_create_new_event_without_permission()
    {
        $user = User::factory()->usuario_externo()->create();

        $response = $this->post('/eventos', [
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
        ]);

        $response->assertStatus(400);
    }
}