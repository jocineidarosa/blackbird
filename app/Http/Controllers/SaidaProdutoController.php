<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\SaidaProduto;
use App\Models\MotivoSaidaProduto;

class SaidaProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $saidas_produtos = SaidaProduto::orderBy('data')->paginate(15);
        return view('app.saida_produto.index', [
            'saidas_produtos' => $saidas_produtos,
            'request'=>$request->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produtos = Produto::all();
        $tipos_saida = MotivoSaidaProduto::all();

        return view(
            'app.saida_produto.create',
            [
                'produtos' => $produtos,
                'tipos_saida' => $tipos_saida
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SaidaProduto::create($request->all());
        $produto = Produto::find($request->input('produto_id')); //busca o registro do produto com o id da entrada do produto
        $produto->estoque_atual = $produto->estoque_atual - $request->input('quantidade'); // soma estoque antigo com a entrada de produto
        $produto->save();
        return redirect()->route('saida-produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaidaProduto $saida_produto)
    {
        if ($saida_produto->motivo == 1) {
            $message = 'Não pode ser ecluido';
        } else {
            $produto = Produto::find($saida_produto->produto_id); //busca o registro do produto com o id da entrada do produto
            $produto->estoque_atual = $produto->estoque_atual + $saida_produto->quantidade; // soma estoque antigo com a entrada de produto
            $produto->save();
            $message='';
            $saida_produto->delete();
        }
        $saidas_produtos = SaidaProduto::all();
        return view('app.saida_produto.index', ['saidas_produtos' => $saidas_produtos, 'message' => $message]);
    }
}
