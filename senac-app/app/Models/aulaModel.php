<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class aulaModel extends Model
{
    use HasFactory;
 
    protected $table = 'aulas';
 
    protected $fillable = [
        'curso_id',
        'uc_id',
        'dia',
        'status',
        'docente_responsavel_id',
    ];
 
    // RELACIONAMENTOS
 
    // Turmas vinculadas à aula
    public function turmas()
    {
        return $this->belongsToMany(
            turmaModel::class,
            'aula_turma',
            'aula_id',
            'turma_id'
        );
    }
 
    // Docentes adicionais vinculados à aula
    public function docentes()
    {
        return $this->belongsToMany(
            docenteModel::class,
            'aula_docente',
            'aula_id',
            'docente_id'
        );
    }
 
    // Curso da aula
    public function curso()
    {
        return $this->belongsTo(cursoModel::class, 'curso_id');
    }
 
    // UC da aula
    public function uc()
    {
        return $this->belongsTo(ucModel::class, 'uc_id');
    }
 
    // Docente responsável pela aula
    public function docenteResponsavel()
    {
        return $this->belongsTo(
            docenteModel::class,
            'docente_responsavel_id'
        )->withDefault([
            'nomeDocente' => 'Sem docente'
        ]);
    }
 
    // STATUS CALCULADO (SEM SALVAR NO BANCO)
    public function getStatusCalculadoAttribute()
    {
        $hoje = date('Y-m-d');
 
        if ($this->dia > $hoje) return 'prevista';
        if ($this->dia == $hoje) return 'andamento';
        return 'pendente';
    }
}