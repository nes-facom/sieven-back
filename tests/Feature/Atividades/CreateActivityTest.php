<?php

namespace Tests\Feature\Atividades;

use App\Models\User;
use App\Models\Evento;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateActivityTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_create_activity_screen_can_be_rengered()
    {
        $response = $this->get('/atividades');
        $response->assertStatus(200);
    }

    public function test_create_new_activity()
    {
        $evento = Evento::factory()->create();

        $response = $this->post('/atividades', [
            'evento_id' => $evento->id,
            'nome' => 'Event Test',
            'descricao' => 'Test Description',
            'endereco' => 'Test Local',
            'modalidade' => 'Presencial',
            'quantidade_vagas' => 100,
            'horario_inicio' => '2023-05-10 08:00:00',
            'horario_encerramento' => '2023-05-10 10:00:00',
            'requisitos' => 'Não há requisitos',
            'acessibilidade' => 'Não há acessibilidade',
            'link_atividade' => 'https://meet.google.com/',
            'situacao' => 'Ativa',
            'created_at' => '2023-05-05 08:00:00',
            'updated_at' => '2023-05-05 08:00:00',
        ]);

        $response->assertStatus(200);
    }

    public function test_create_new_activity_invalid_register_date()
    {
        $evento = Evento::factory()->create();

        $response = $this->post('/atividades', [
            'evento_id' => $evento->id,
            'nome' => 'Event Test',
            'descricao' => 'Test Description',
            'endereco' => 'Test Local',
            'modalidade' => 'Presencial',
            'quantidade_vagas' => 100,
            'horario_inicio' => '2023-05-10 08:00:00',
            'horario_encerramento' => '2023-05-10 10:00:00',
            'requisitos' => 'Não há requisitos',
            'acessibilidade' => 'Não há acessibilidade',
            'link_atividade' => 'https://meet.google.com/',
            'situacao' => 'Ativa',
            'created_at' => '2023-05-05 08:00:00',
            'updated_at' => '2023-05-05 06:00:00',
        ]);

        $response->assertStatus(400);
    }

    public function test_create_new_activity_invalid_duration_date()
    {
        $evento = Evento::factory()->create();

        $response = $this->post('/atividades', [
            'evento_id' => $evento->id,
            'nome' => 'Event Test',
            'descricao' => 'Test Description',
            'endereco' => 'Test Local',
            'modalidade' => 'Presencial',
            'quantidade_vagas' => 100,
            'horario_inicio' => '2023-05-10 08:00:00',
            'horario_encerramento' => '2023-05-10 07:00:00',
            'requisitos' => 'Não há requisitos',
            'acessibilidade' => 'Não há acessibilidade',
            'link_atividade' => 'https://meet.google.com/',
            'situacao' => 'Ativa',
            'created_at' => '2023-05-05 08:00:00',
            'updated_at' => '2023-05-05 08:00:00',
        ]);

        $response->assertStatus(400);
    }

    public function test_create_new_activity_negative_number_seats()
    {
        $evento = Evento::factory()->create();

        $response = $this->post('/atividades', [
            'evento_id' => $evento->id,
            'nome' => 'Event Test',
            'descricao' => 'Test Description',
            'endereco' => 'Test Local',
            'modalidade' => 'Presencial',
            'quantidade_vagas' => -10,
            'horario_inicio' => '2023-05-10 08:00:00',
            'horario_encerramento' => '2023-05-10 10:00:00',
            'requisitos' => 'Não há requisitos',
            'acessibilidade' => 'Não há acessibilidade',
            'link_atividade' => 'https://meet.google.com/',
            'situacao' => 'Ativa',
            'created_at' => '2023-05-05 08:00:00',
            'updated_at' => '2023-05-05 08:00:00',
        ]);

        $response->assertStatus(400);
    }

    public function test_create_new_activity_invalid_modalidade()
    {
        try {
            $response = $this->post('/atividades', [
                'evento_id' => $evento->id,
                'nome' => 'Event Test',
                'descricao' => 'Test Description',
                'endereco' => 'Test Local',
                'modalidade' => 'Modalidade Inválida',
                'quantidade_vagas' => 100,
                'horario_inicio' => '2023-05-10 08:00:00',
                'horario_encerramento' => '2023-05-10 10:00:00',
                'requisitos' => 'Não há requisitos',
                'acessibilidade' => 'Não há acessibilidade',
                'link_atividade' => 'https://meet.google.com/',
                'situacao' => 'Ativa',
                'created_at' => '2023-05-05 08:00:00',
                'updated_at' => '2023-05-05 08:00:00',
            ]);

            $this->fail('Modalidade inválida');
        } 
        
        catch (\Exception $e) 
        {
            $this->assertInstanceOf(\Exception::class, $e);
        }
    }

    public function test_create_new_activity_invalid_situacao()
    {
        try {
            $response = $this->post('/atividades', [
                'evento_id' => $evento->id,
                'nome' => 'Event Test',
                'descricao' => 'Test Description',
                'endereco' => 'Test Local',
                'modalidade' => 'Presencial',
                'quantidade_vagas' => 100,
                'horario_inicio' => '2023-05-10 08:00:00',
                'horario_encerramento' => '2023-05-10 10:00:00',
                'requisitos' => 'Não há requisitos',
                'acessibilidade' => 'Não há acessibilidade',
                'link_atividade' => 'https://meet.google.com/',
                'situacao' => 'Situação Inválida',
                'created_at' => '2023-05-05 08:00:00',
                'updated_at' => '2023-05-05 08:00:00',
            ]);

            $this->fail('Modalidade inválida');
        } 
        
        catch (\Exception $e) 
        {
            $this->assertInstanceOf(\Exception::class, $e);
        }
    }

    public function test_create_new_activity_not_permited_situacao()
    {
        $evento = Evento::factory()->create();

        $response = $this->post('/atividades', [
            'evento_id' => $evento->id,
            'nome' => 'Event Test',
            'descricao' => 'Test Description',
            'endereco' => 'Test Local',
            'modalidade' => 'Presencial',
            'quantidade_vagas' => 10,
            'horario_inicio' => '2023-05-10 08:00:00',
            'horario_encerramento' => '2023-05-10 10:00:00',
            'requisitos' => 'Não há requisitos',
            'acessibilidade' => 'Não há acessibilidade',
            'link_atividade' => 'https://meet.google.com/',
            'situacao' => 'Cancelada',
            'created_at' => '2023-05-05 08:00:00',
            'updated_at' => '2023-05-05 08:00:00',
        ]);

        $response->assertStatus(400);
    }

}