<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\cursoModel;

class ucModel extends Model
{
    use HasFactory;

    protected $table = 'uc';

    // UC pertence a UM curso
    public function curso()
    {
        return $this->belongsTo(
            cursoModel::class,
            'cursoCodigo',
            'id'
        );
    }

    public function cursos()
    {
        return $this->belongsToMany(
            cursoModel::class,
            'curso_uc',
            'uc_id',
            'curso_id'
        );
    }

    public function docentes()
    {
        return $this->belongsToMany(
            docenteModel::class,
            'docente_uc',
            'uc_id',
            'docente_id'
        );
    }
}
