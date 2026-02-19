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
        return $this->belongsTo(cursoModel::class, 'curso_id');
    }

    public function docentes()
    {
        return $this->belongsToMany(
            docenteModel::class,
            'docente_turma',
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
    
    public function aulas()
    {
        return $this->hasMany(aulaModel::class, 'turma_id');
    }
}