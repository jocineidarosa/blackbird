<?php

namespace App\Http\Controllers;

use App\Models\Abastecimento;
use App\Models\Equipamento;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\SaidaProduto;
use App\Models\Consumo;
use Illuminate\Support\Facades\DB;

class AbastecimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $equipamentos = Equipamento::all();
        if ($request->filtro_equipamento) {
            $abastecimentos = DB::table('abastecimentos as ab')
                ->join('equipamentos as eq', 'eq.id', '=', 'ab.equipamento_id')
                ->join('produtos as pd', 'pd.id', '=', 'ab.produto_id')
                ->selectRaw('ab.id as id, eq.nome as equipamento, pd.nome as produto, ab.quantidade as quantidade, ab.data as data ')
                ->where('eq.nome',  'like', '%' . $request->filtro_equipamento . '%')->paginate(12);
        } else {
            $abastecimentos = DB::table('abastecimentos as ab')
                ->join('equipamentos as eq', 'eq.id', '=', 'ab.equipamento_id')
                ->join('produtos as pd', 'pd.id', '=', 'ab.produto_id')
                ->selectRaw('ab.id as id, eq.nome as equipamento, pd.nome as produto, ab.quantidade as quantidade, ab.data as data ')->paginate(12);
        }


        return view('app.abastecimento.index', ['abastecimentos' => $abastecimentos, 'equipamentos' => $equipamentos, 'request' => $request->all()]);
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
        return view('app.abastecimento.create', ['equipamentos' => $equipamentos, 'produtos' => $produtos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Abastecimento::create($request->all());

        $controle = Equipamento::find($request->equipamento_id);
        $controle_consumo = $controle->controle_consumo;
        $controle_saida = $controle->controle_saida;
        
        if ($controle_saida == 0) {
            $saida_produto = new SaidaProduto();
            $saida_produto->equipamento_id = $request->equipamento_id;
            $saida_produto->produto_id = $request->produto_id;
            $saida_produto->quantidade = $request->quantidade;
            $saida_produto->motivo = '1';
            $saida_produto->data = $request->data;
            $saida_produto->save();

            $produto = Produto::find($request->produto_id);
            $produto->estoque_atual = $produto->estoque_atual - $request->quantidade; // soma estoque antigo com a entrada de produto
            $produto->save();
        }



        if ($controle_consumo == 1) {
            Consumo::create($request->all());
        } else {
            $equipamento = Equipamento::find($request->equipamento_id);
            $equipamento->quant_tanque = $equipamento->quant_tanque + $request->quantidade;
            $equipamento->save();
        }


        return redirect()->route('abastecimento.index');
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
    public function destroy($id)
    {
        //
    }
}
