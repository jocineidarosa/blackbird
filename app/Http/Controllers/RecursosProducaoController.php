<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecursosProducao;
use App\Models\Produto;
use App\Models\Equipamento;
use App\Models\OrdemProducao;
use App\Models\ParadaEquipamento;
use App\Models\SaidaProduto;

class RecursosProducaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operacoes = RecursosProducao::all();
        return view('app.operacao_equipamento.index', ['operacoes' => $operacoes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipamentos = Equipamento::all();
        $produtos = Produto::all();
        return view(
            'app.operacao_equipamento.create',
            [
                'equipamentos' => $equipamentos,
                'produtos' => $produtos
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, OrdemProducao $ordem_producao)
    {
        $produtos = Produto::all();
        $equipamentos = Equipamento::all();
        $paradas_equipamento = ParadaEquipamento::where('ordem_producao_id', $ordem_producao->id)->get();
        //$ordem_producao= OrdemProducao::find($ordem_producao);
        $recurso_producao = new RecursosProducao();
        $recurso_producao->ordem_producao_id = $ordem_producao->id;
        $recurso_producao->equipamento_id = $request->input('equipamento_id');

        $exists_recurso_producao = RecursosProducao::where('ordem_producao_id', $ordem_producao->id)->where('equipamento_id', $recurso_producao->equipamento_id)->get()->first();

        if (isset($exists_recurso_producao)) { //verifica re o recurso já existe na ordem se já, não deixa cadastrar.
            $recursos_producao = RecursosProducao::where('ordem_producao_id', $ordem_producao->id)->get();
            return view('app.ordem_producao.create', [
                'produtos' => $produtos,
                'equipamentos' => $equipamentos,
                'ordem_producao' => $ordem_producao,
                'recursos_producao' => $recursos_producao,
                'paradas_equipamento' => $paradas_equipamento
            ]);
            //se já existe o recurso na ordem-> faz a consulta novamente e sai do função,não executa o codigo abaixo

        }
        //salva recursos de produção no banco de dados
        $recurso_producao->produto_id = $request->input('produto_id');
        $recurso_producao->quantidade = $request->input('quantidade');
        $recurso_producao->horimetro_final = $request->input('horimetro_final');
        $recurso_producao->data_inicio = $request->input('data_inicio');
        $recurso_producao->data_fim = $request->input('data_fim');
        $recurso_producao->hora_inicio = $request->input('hora_inicio');
        $recurso_producao->hora_fim = $request->input('hora_fim');
        $recurso_producao->save();

        $saida_produto = new SaidaProduto();
        $saida_produto->produto_id = $request->input('produto_id');
        $saida_produto->recursos_producao_id = $recurso_producao->id ;
        $saida_produto->quantidade = $request->input('quantidade');
        $saida_produto->motivo = '1';
        $saida_produto->data = $request->input('data_inicio');
        $saida_produto->save();

        $produto = Produto::find($request->input('produto_id'));
        $produto->estoque_atual = $produto->estoque_atual - $request->input('quantidade'); // soma estoque antigo com a entrada de produto
        $produto->save();

        $recursos_producao = RecursosProducao::where('ordem_producao_id', $ordem_producao->id)->get();

        return view(
            'app.ordem_producao.create',
            [
                'produtos' => $produtos,
                'equipamentos' => $equipamentos,
                'ordem_producao' => $ordem_producao,
                'recursos_producao' => $recursos_producao,
                'paradas_equipamento' => $paradas_equipamento
            ]
        );
    }

    public function store_avulso(Request $request)
    {
        $recursos_producao =RecursosProducao::create($request->all());

        $saida_produto = new SaidaProduto();
        $saida_produto->produto_id = $request->input('produto_id');
        $saida_produto->recursos_producao_id= $recursos_producao->id;
        $saida_produto->quantidade = $request->input('quantidade');
        $saida_produto->motivo = '1';
        $saida_produto->data = $request->input('data_inicio');
        $saida_produto->save();

        $produto = Produto::find($saida_produto->produto_id); //busca o registro do produto com o id da entrada do produto
        $produto->estoque_atual = $produto->estoque_atual - $saida_produto->quantidade; // soma estoque antigo com a entrada de produto
        $produto->save();

        return redirect(route('recursos-producao.index'));
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
    public function destroy(RecursosProducao $operacao)
    {
        $saida_produto= SaidaProduto::where('recursos_producao_id', $operacao->id)->first();
        $produto = Produto::find($saida_produto->produto_id); //busca o registro do produto com o id da entrada do produto
        $produto->estoque_atual = $produto->estoque_atual + $saida_produto->quantidade; // soma estoque antigo com a entrada de produto
        $produto->save();
        $saida_produto->delete();
        $operacao->delete();
        return redirect(route('recursos-producao.index'));
    }
}
