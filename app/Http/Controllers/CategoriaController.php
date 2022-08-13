<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index(Request $request){
        $categorias = Categoria::orderBy('nome')->paginate(12); 
        return view('app.categoria.index', 
        [
            'categorias'=>$categorias,
            'request'=>$request->all()
        ]);
    }

    public function create(){
        return view('app.categoria.create');
    }

    public function store(Request $request){

        Categoria::create($request->all());
        return redirect(route('category.index'));
    }

    public function show(Categoria $categoria){
        return view('app.category.show', ['categoria'=>$categoria]);

    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */

    public function destroy(Categoria $category){

        $category->delete();
        return redirect(route('category.index'));
    }
}
