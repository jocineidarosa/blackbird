<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;
    protected $fillable= ['placa', 'tipo_veiculo_id', 'funcionario_id', 'observacao'];

    public function tipo_veiculo(){
        return $this->belongsTo('App\Models\TipoVeiculo');
    }

    public function funcionario(){
        return $this->belongsTo('App\Models\Funcionario');
    }
}
