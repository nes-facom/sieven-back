<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    use HasFactory;

    protected $table = 'atividade';

    protected $fillable = [
        'evento_id',
        'nome',
        'descricao',
        'local',
        'id_modalidade',
        'quantidade_vagas',
        'horario_inicio',
        'horario_encerramento',
        'quantidade_vagas',      
        'created_at',
        'updated_at',
    ];
    
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'evento_id');
    }

    public function cargoCadastro()
    {
        return $this->belongsTo(Cargo::class, 'cargo_cadastro_id');
    }

    public function cargoAlteracao()
    {
        return $this->belongsTo(Cargo::class, 'cargo_alteracao_id');
    }

    public function situacao()
    {
        return $this->belongsTo(Situacao::class, 'situacao_id');
    }
}
