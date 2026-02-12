<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class turmaModel extends Model
{
    use HasFactory;

    protected $table = 'turma';

    protected $fillable = [
        'curso_id',
        'codigoTurma',
        'dataInicio',
        'dataFim',
        'turno',
        'status',
    ];

    public function curso()
    {
        return $this->belongsTo(cursoModel::class, 'curso_id', 'id');
    }

    public function docentes()
    {
        return $this->belongsToMany(
            docenteModel::class,
            'turma_docente',
            'turma_id',
            'docente_id'
        );
    }

    public function alunos()
    {
        return $this->belongsToMany(
            alunoModel::class,
            'aluno_turma',
            'turma_id',
            'aluno_id'
        );
    }
}