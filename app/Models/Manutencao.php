<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manutencao extends Model
{
    use HasFactory;
    protected $table = 'manutencoes';
    protected $fillable=['data_inicio', 'data_fim', 'hora_inicio', 'hora_fim', 'equipamento_id', 'descricao', 'tipo_manutencao'];


    public function Equipamento()
    {
        return $this->belongsTo('\App\Models\Equipamento', 'equipamento_id', 'id');   
    }
}
