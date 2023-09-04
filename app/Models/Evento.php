<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'evento';
 
    protected $fillable = [
        'nome',
        'descricao',
        'local',
        'id_categoria',
        'id_tipo',
        'data_inicial',
        'data_final',
        'hora_inicial',
        'hora_final',
        'created_by_user',
        'situacao',
        'imagem',
        'created_at',
        'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($evento) {
            if ($evento->isDirty()) {
                $evento->updated_at = now();
            }
        });
    }
    
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by_user');
    }
}
