<?php

namespace App\Http\Controllers;

use App\Models\UnidadeMedida;
use Illuminate\Http\Request;

class UnidadeMedidaController extends Controller
{
    
public function index(Request $request){
    $unidades_medidas= UnidadeMedida::orderBy('nome')->paginate(12);
    return view('app.unidade_medida.index', 
    [
        'unidades_medidas'=>$unidades_medidas,
        'request'=>$request->all()
]);
}

public function create(){
    return view('app.unidade_medida.create');
}

public function store(Request $request){
    UnidadeMedida::create($request->all());
    return  redirect()->route('unidade-medida.index');

}

public function show(UnidadeMedida $unidade_medida){
    return view('app.unidade_medida.show', ['unidade_medida'=>$unidade_medida]);

}

public function edit(UnidadeMedida $unidade_medida){
    return view('app.unidade_medida.edit', ['unidade_medida'=>$unidade_medida]);

}

public function update(UnidadeMedida $unidade_medida){

}

public function destroy(UnidadeMedida $unidade_medida){
    $unidade_medida->delete();
    return redirect()->route('unidade-medida.index');
}
}
