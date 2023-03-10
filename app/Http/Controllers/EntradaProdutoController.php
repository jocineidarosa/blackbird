<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntradaProduto;
use App\Models\Produto;
use App\Models\Empresa;
use App\Models\Fornecedor;

class EntradaProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $entradas_produtos = EntradaProduto::orderBy('data', 'desc')->paginate(12);
        return view('app.entrada_produto.index', [
            'entradas_produtos' => $entradas_produtos,
            'request' => $request->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fornecedores = Fornecedor::all();
        $produtos = Produto::all();
        return view('app.entrada_produto.create', [
            'produtos' => $produtos,
            'fornecedores' => $fornecedores

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
        EntradaProduto::create($request->all());
        $produto = Produto::find($request->input('produto_id')); //busca o registro do produto com o id da entrada do produto
        $produto->estoque_atual = $produto->estoque_atual + $request->input('quantidade'); // soma estoque antigo com a entrada de produto
        $produto->save();
        return redirect()->route('entrada-produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EntradaProduto $entrada_produto)
    {
        return view('app.entrada_produto.show', ['entrada_produto'=>$entrada_produto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EntradaProduto $entrada_produto)
    {
        $produtos = Produto::all();
        $fornecedores = Fornecedor::all();
        return view('app.entrada_produto.edit', [
            'produtos' => $produtos, 
            'fornecedores' => $fornecedores, 
            'entrada_produto' => $entrada_produto
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntradaProduto $entrada_produto)
    {
        $diferenca_atualizada=$request->quantidade - $entrada_produto->quantidade;
        $entrada_produto->update($request->all());
        $produto = Produto::findOrFail($entrada_produto->produto_id);
        $produto->estoque_atual = $produto->estoque_atual + $diferenca_atualizada;
        $produto->save();
        return redirect()->route('entrada-produto.index');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EntradaProduto $equipamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $entrada_produto = EntradaProduto::find($request->data_id);
        $entrada_produto->delete();

        $produto = Produto::findOrFail($entrada_produto->produto_id);
        $produto->estoque_atual = $produto->estoque_atual - $entrada_produto->quantidade;
        $produto->save();
        return redirect()->route('entrada-produto.index');
    }
}
