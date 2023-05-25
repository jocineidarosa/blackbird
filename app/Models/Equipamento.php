<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    use HasFactory;
    protected $fillable=[
        'nome', 'descricao', 'marca_id', 'modelo', 'potencia', 'tipo_potencia',
        'data_fabricacao','equipamento_pai', 'combustivel', 'controle_consumo'];

    public function marca(){
       return $this->belongsTo('\App\Models\Marca', 'marca_id', 'id' );
    }
    public function maquina(){
       return $this->belongsTo('\App\Models\Maquina', 'maquina_id', 'id');
    }
    public function equip_pai(){
        return $this->belongsTo('\App\Models\Equipamento', 'equipamento_pai', 'id');
     }
}

