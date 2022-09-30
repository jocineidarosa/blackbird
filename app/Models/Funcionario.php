<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;
    protected $fillable=['pessoa_id','num_registro','data_admissao','data_demissao','salario'];

    public function pessoa(){
        return $this->belongsTo('App\Models\Pessoa');
    }
}
