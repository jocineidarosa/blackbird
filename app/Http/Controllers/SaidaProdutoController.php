<?php

namespace App\Http\Controllers;

use App\Models\EntradaProduto;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\SaidaProduto;
use App\Models\MotivoSaidaProduto;
use Illuminate\Support\Facades\DB;

class SaidaProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->filtro_produto){
            $saidas_produtos=DB::table('produtos as p')->join('saidas_produtos as sp', 'p.id', '=', 'sp.produto_id')
            ->join('motivo_saidas_produto as ms', 'ms.id', '=' ,'sp.motivo' )
            ->selectRaw('sp.*, p.nome as produto, ms.motivo as motivo')->where('p.nome', 'like', '%'.$request->filtro_produto.'%')->orderBy('data', 'desc')->paginate('12');
        }else{
            $saidas_produtos=DB::table('produtos as p')->join('saidas_produtos as sp', 'p.id', '=', 'sp.produto_id')
            ->join('motivo_saidas_produto as ms', 'ms.id', '=' ,'sp.motivo' )
            ->selectRaw('sp.*, p.nome as produto, ms.motivo as motivo')->orderBy('data', 'desc')->paginate('12');
        }

        return view('app.saida_produto.index', [
            'saidas_produtos' => $saidas_produtos,
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
    public function show(SaidaProduto $saida_produto)
    {
        return view('app.saida_produto.show', ['saida_produto'=>$saida_produto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SaidaProduto $saida_produto)
    {
        $produtos = Produto::all();
        $tipos_saida= MotivoSaidaProduto::all();
        return view('app.saida_produto.edit', [
            'saida_produto' => $saida_produto, 
            'produtos' => $produtos,
            'tipos_saida'=>$tipos_saida
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaidaProduto $saida_produto)
    {
        $diferenca_atualizada=$request->quantidade - $saida_produto->quantidade;
        $produto = Produto::find($saida_produto->produto_id);
        $produto->estoque_atual= $produto->estoque_atual - $diferenca_atualizada;
        $produto->save();
        $saida_produto->update($request->all());
        return redirect()->route('saida-produto.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $saida_produto = SaidaProduto::find($request->data_id);
        $produto = Produto::find($saida_produto->produto_id); //busca o registro do produto com o id da entrada do produto
        $produto->estoque_atual = $produto->estoque_atual + $saida_produto->quantidade; // soma estoque antigo com a entrada de produto
        $produto->save();
        $saida_produto->delete();
        $saidas_produtos = SaidaProduto::all();
        return redirect()->route('saida-produto.index');
    }
}
