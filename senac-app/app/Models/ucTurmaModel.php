<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UcTurmaModel extends Model
{
    protected $table = 'uc_turma';

    protected $fillable = [
        'uc_id',
        'turma_id',
        'data_inicio',
        'data_fim',
        'status'
    ];

    public function uc()
    {
        return $this->belongsTo(ucModel::class);
    }

    public function turma()
    {
        return $this->belongsTo(turmaModel::class);
    }
}