<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'insc_estadual',
        'endereco',
        'bairro',
        'cidade',
        'estado',
        'telefone',
        'contato',
        'email',
        'site'


    ];
}
