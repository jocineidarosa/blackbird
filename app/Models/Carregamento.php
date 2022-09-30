<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Veiculo;

class Carregamento extends Model
{
    use HasFactory;
    protected $fillable=['veiculo_id', 'hora_saida', 'tracos', 'peso', 'observacao'];

    public function rules(){
        return [
            'veiculo_id'=>'required',
            
        ];
    }

    public function feedback(){
        return [
            'required'=>'O campo :attribute não pode estar vazio!',
        ];
    }

    function veiculo(){
        return $this->belongsTo(veiculo::class);
    }

}
