<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaidaProduto extends Model
{
    use HasFactory;

    protected $table= 'saidas_produtos';

    protected $fillable=
    [
        'produto_id', 'quantidade', 'data'
    ];

    public function produto(){
        return $this->belongsTo('App\Models\Produto', 'produto_id', 'id');
    }
}
