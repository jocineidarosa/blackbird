<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;
    protected $fillable=['num_registro','data_admissao','data_demissao','salario', 
    'nome_completo', 'cpf', 'rg', 'telefone', 'data_nascimento', 'cidade_id', 'endereco'];

    public function cidade(){
        return $this->belongsTo('App\Models\Cidade');
    }
}
