<?php

namespace Tests\Feature\Atividades;

use App\Models\User;
use App\Models\Atividade;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateActivityTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_activity_screen_can_be_rendered()
    {
        $response = $this->get('/atividades');
        $response->assertStatus(200);
    }

    public function test_update_activity()
    {
        $atividade = Atividade::factory()->create();

        $response = $this->put('/atividades/' . $atividade->id, [
            'nome' => 'Updated Activity',
        ]);
        
        $response->assertStatus(200);
    }

    public function test_update_no_registered_activity()
    {
        $response = $this->put('/atividades/100', [
            'nome' => 'Updated Activity',
        ]);
        
        $response->assertStatus(404);
    }

    public function test_update_activity_invalid_register_date()
    {
        $atividade = Atividade::factory()->create();

        $response = $this->put('/atividades/' . $atividade->id, [
            'created_at' => '2023-05-04 16:00:00',
            'updated_at' => '2023-05-04 12:00:00',
        ]);
        
        $response->assertStatus(400);
    }

    public function test_update_activity_invalid_duration_date()
    {
        $atividade = Atividade::factory()->create();

        $response = $this->put('/atividades/' . $atividade->id, [
            'horario_inicio' => '2023-05-04 16:00:00',
            'horario_encerramento' => '2023-05-04 12:00:00',
        ]);
        
        $response->assertStatus(400);
    }

    public function test_update_activity_invalid_number_seats()
    {
        $atividade = Atividade::factory()->create();

        $response = $this->put('/atividades/' . $atividade->id, [
            'quantidade_vagas' => -10,
        ]);
        
        $response->assertStatus(400);
    }

    public function test_update_activity_invalid_modalidade()
    {
        $atividade = Atividade::factory()->create();

        try 
        {
            $response = $this->put('/atividades/' . $atividade->id, [
                'modalidade' => 'Modalidade Inválida',
            ]);

            $this->fail('Modalidade inválida');
        }
        catch (\Exception $e) 
        {
            $this->assertInstanceOf(\Exception::class, $e);
        }
    }

    public function test_update_activity_invalid_situacao()
    {
        $atividade = Atividade::factory()->create();

        try 
        {
            $response = $this->put('/atividades/' . $atividade->id, [
                'situacao' => 'Situação Inválida',
            ]);

            $this->fail('Modalidade inválida');
        }
        catch (\Exception $e) 
        {
            $this->assertInstanceOf(\Exception::class, $e);
        }
    }
}