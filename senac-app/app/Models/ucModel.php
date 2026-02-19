<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ucModel extends Model
{
    use HasFactory;

    protected $table = 'uc';

    protected $fillable = [
        'codigoUc',
        'nome',
        'cargaHoraria',
        'presencaMinima',
        'descricao',
        'status',
        'cursoCodigo'
    ];

    // Relacionamentos
    public function curso()
    {
        return $this->belongsTo(cursoModel::class, 'cursoCodigo', 'id');
    }


    public function docentes()
    {
        return $this->belongsToMany(docenteModel::class, 'docente_uc', 'uc_id', 'docente_id');
    }


    public function aulas()
    {
        return $this->hasMany(aulaModel::class, 'uc_id', 'id');
    }

    public function aluno()
    {
        return $this->belongsToMany(
            ucModel::class,
            'aluno_uc',
            'uc_id',
            'aluno_id'
        );
    }
    public function turmas()
    {
        return $this->belongsToMany(
            turmaModel::class,
            'uc_turma',
            'uc_id',
            'turma_id'
        );
    }
    public function indicadores()
    {
        return $this->belongsToMany(
            indicadorModel::class,
            'indicador_uc',
            'uc_id',
            'indicador_id'
        );
    }
}