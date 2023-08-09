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
        'modalidade',
        'data_inicial',
        'data_final',
        'created_by_user',
        'situacao',
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
