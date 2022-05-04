<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Uf;

class Cidade extends Model
{
    use HasFactory;

    protected $fillable=[
        'nome', 'uf_id'
    ];

    public function uf(){
        return $this->belongsTo(Uf::class);
    }
}
