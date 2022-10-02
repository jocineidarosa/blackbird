<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\UnidadeMedida;
use App\Models\Categoria;

//use phpDocumentor\Reflection\Types\This;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $produtos=Produto::orderBy('nome', 'asc')->paginate(12);
        return view('app.produto.index', ['produtos'=>$produtos, 'request'=>$request->all()] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = Marca::all();
        $unidades = UnidadeMedida::all();
        $categorias = Categoria::all();
        return view('app.produto.create', 
            [
                'marcas'=>$marcas,
                'unidades'=>$unidades,
                'categorias'=>$categorias
            ]);

    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Produto::create($request->all());
        return redirect()->route('produto.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        return view('app.produto.show', ['produto'=>$produto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        $unidades = UnidadeMedida::all();
        $categorias = Categoria::all();
        $marcas=Marca::all();
        return view('app.produto.edit', 
            ['produto'=>$produto, 
            'marcas'=>$marcas, 
            'unidades'=>$unidades, 
            'categorias'=>$categorias
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, Produto $produto)
    {
        $produto->update($request->all());
        return redirect()->route('produto.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {

        $produto->delete();
        return redirect()->route('produto.index');
    }
}
