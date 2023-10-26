<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'telefone',
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
