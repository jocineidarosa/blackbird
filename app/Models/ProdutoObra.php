<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoObra extends Model
{
    use HasFactory;
    protected $table = 'produtos_obra';
    protected $fillable = ['obra_id', 'produto_id', 'ordem_producao_id', 'quantidade'];

    public function produto(){
        return $this->belongsTo(Produto::class);
    }

    public function obra(){
        return $this->belongsTo(Obra::class);
    }
}
