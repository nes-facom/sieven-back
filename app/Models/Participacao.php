<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participacao extends Model
{
    use HasFactory;

    protected $table = 'participacao';

    protected $fillable = [
        'user_id',
        'atividade_id',
        'situacao',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function atividade()
    {
        return $this->belongsTo(Atividade::class);
    }

}
