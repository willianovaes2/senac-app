<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\turmaModel;
use App\Models\ucModel;

class cursoModel extends Model
{
    use HasFactory;
    protected $table='curso';
    
    protected $casts = [
        'dias' => 'array', 
    ];

    // Curso -> UCs
    public function ucs()
    {
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