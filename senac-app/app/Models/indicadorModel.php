<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicadorModel extends Model
{
    use HasFactory;

    protected $table = 'indicadores';
    protected $fillable = ['nome', 'descricao'];

    // Relação Many-to-Many com UCs
    public function ucs()
{
    return $this->belongsToMany(
        ucModel::class,
        'indicador_uc',
        'indicador_id',
        'uc_id'
    );
}
}