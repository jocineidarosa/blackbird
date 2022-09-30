<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;
    protected $fillable=['nome', 'sobrenome', 'contato', 'cpf', 'rg',
     'titulo_eleitor', 'data_nascimento', 'endereco', 'cidade_id'];
}
