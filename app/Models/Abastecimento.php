<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipamento;
use App\Models\Produto;

class Abastecimento extends Model
{
    use HasFactory;
    protected $fillable=['equipamento_id','produto_id', 'quantidade', 'data'];

    public function equipamento(){
        return $this->belongsTo(Equipamento::class);
    }

    public function produto(){
        return $this->belongsTo(Produto::class);
    }
}
