<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alunoModel extends Model
{
    use HasFactory;
    protected $table = 'aluno';
    protected $fillable = [
        'nomeAluno',
        'intencao',
        'ra',
        'cpf',
        'dataNascimento',
        'telefone',
        'emailAluno',
        'senhaAluno',
        'endereco',
        'dataMatricula',
        'tipo',
        'status',
    ];

    /*
     * Gera o RA automaticamente antes de salvar
     */
    protected static function booted()
    {
        static::creating(function ($aluno) {
            $aluno->ra = self::gerarRa();
        });
    }

    /**
     * Gera um RA único com exatamente 10 dígitos
     */
    private static function gerarRa()
    {
        do {
            $ra = str_pad(
                random_int(0, 9999999999),
                10,
                '0',
                STR_PAD_LEFT
            );
        } while (self::where('ra', $ra)->exists());

        return $ra;
    }

    public function turmas()
    {
        return $this->belongsToMany(
            turmaModel::class,
            'aluno_turma',
            'aluno_id',
            'turma_id'
        );
    }

    public function aulas()
    {
        return $this->belongsToMany(
            aulaModel::class,
            'aula_aluno',
            'aluno_id',
            'aula_id'
        )->withPivot('presente', 'conceito_final')
            ->withTimestamps();
    }

    public function avaliacoesParciais()
    {
        return $this->hasMany(avaliacaoParcialModel::class, 'aluno_id');
    }
}