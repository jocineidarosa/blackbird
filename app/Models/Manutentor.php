<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manutentor extends Model
{
    use HasFactory;
    protected $table="manutentores";
    protected $fillable=['manutencao_id', 'funcionario_id', 'data_inicio','hora_inicio', 'data_fim','hora_fim' ];
}
