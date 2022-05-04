<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Empresa;
use App\Models\Pessoa;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable=[
        'empresa_id', 'pessoa_id','data_inicio'
    ];

    public function empresa(){
        return $this->belongsTo(Empresa::class);
    }

    public function pessoa(){
        return $this->belongsTo(Pessoa::class);
    }
}
