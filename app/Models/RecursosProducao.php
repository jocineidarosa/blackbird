<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecursosProducao extends Model
{
    use HasFactory;
    protected $table='recursos_producao';
    protected $fillable=
    [
        'ordem_producao_id',
        'equipamento_id',
        'produto_id',
        'quantidade',
        'horimetro_final',
        'data',
        'hora_inicio',
        'hora_fim'
    ];

    public function produto(){
        return $this->belongsTo('App\Models\Produto');
    }

    public function equipamento(){
        return $this->belongsTo('App\Models\Equipamento');
    }

}
