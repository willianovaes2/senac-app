<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class avaliacaoParcialModel extends Model
{
    use HasFactory;
    protected $table = 'avaliacao_parcial';

    protected $fillable = [
        'aula_id',
        'aluno_id',
        'conceito_final'
    ];
}