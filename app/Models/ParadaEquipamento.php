<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParadaEquipamento extends Model
{
    use HasFactory;
    protected $table='paradas_equipamentos';
    protected $fillable = ['ordem_producao_id','hora_inicio', 'hora_fim', 'descricao'];

    public function ordem_producao(){
        return $this->belongsTo('App\Models\OrdemProducao');
    }
}
