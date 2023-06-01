<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;
use App\Models\Equipamento;

class Consumo extends Model
{
    use HasFactory;
    protected $fillable=['equipamento_id', 'produto_id', 'quantidade', 'data'];

    public function produto(){
       return $this->belongsTo(Produto::class);
    }
    
    public function equipamento(){
       return $this->belongsTo(Equipamento::class);
    }
}
