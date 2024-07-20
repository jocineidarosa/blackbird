<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesagem extends Model
{
    use HasFactory;

    protected $table='pesagens';

    public function parceiro(){
        return $this->belongsTo('App\Models\Parceiro');
    }
    public function produto(){
        return $this->belongsTo('App\Models\Produto');
    }
    public function motorista(){
        return $this->belongsTo('App\Models\Motorista');
    }

}
