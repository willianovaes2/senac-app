<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\turmaModel;
use App\Models\ucModel;

class cursoModel extends Model
{
    use HasFactory;

    protected $table = 'curso';

    protected $casts = [
        'dias' => 'array', 
    ];

    // Curso -> Turmas
    public function turmas()
    {
        return $this->hasMany(turmaModel::class, 'curso_id', 'id');
    }

    // Curso -> UCs
    public function ucs()
    {
        return $this->hasMany(ucModel::class, 'cursoCodigo', 'id');
    
        return $this->belongsToMany(
            ucModel::class,
            'curso_uc',
            'curso_id',
            'uc_id'
        );
    }

    public function docentes()
    {
        return $this->belongsToMany(
            docenteModel::class,
            'docente_curso',
            'curso_id',
            'docente_id'
        );
    }
}