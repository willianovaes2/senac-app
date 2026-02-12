<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aulaModel extends Model
{
    use HasFactory;

    protected $table = 'aulas';

    protected $fillable = [
        'nome',
        'data',
        'horaInicio',
        'horaFim',
        'uc_id',
        'situacao'
    ];

    // Aula pertence a um Curso
    public function curso()
    {
        return $this->belongsTo(cursoModel::class, 'curso_id');
    }

    // Aula pertence a uma UC
    public function uc()
    {
        return $this->belongsTo(ucModel::class, 'uc_id');
    }

    // Aula pode ter vários Docentes
    public function docentes()
    {
        return $this->belongsToMany(
            docenteModel::class,
            'aula_docente',
            'aula_id',
            'docente_id'
        );
    }

    // Aula pode ter várias Turmas
    public function turmas()
    {
        return $this->belongsToMany(
            turmaModel::class,
            'aula_turma',
            'aula_id',
            'turma_id'
        );
    }
}