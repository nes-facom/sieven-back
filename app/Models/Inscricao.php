<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'atividade_id',
        'nome',
        'cpf',
        'email',
        'checkin'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($inscricao) {
            $inscricao->uuid = Str::uuid();
        });
    }
}
