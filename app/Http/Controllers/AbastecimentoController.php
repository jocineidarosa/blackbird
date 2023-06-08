<?php

namespace App\Http\Controllers;

use App\Models\Abastecimento;
use App\Models\Equipamento;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\SaidaProduto;
use App\Models\Consumo;
use Illuminate\Support\Facades\DB;
use PDF;

class AbastecimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filtro_equipamento='';
        $equipamentos = Equipamento::all();
        if ($request->filtro_equipamento) {
            $filtro_equipamento=$request->filtro_equipamento;
            $abastecimentos = DB::table('abastecimentos as ab')
                ->join('equipamentos as eq', 'eq.id', '=', 'ab.equipamento_id')
                ->join('produtos as pd', 'pd.id', '=', 'ab.produto_id')
                ->selectRaw('ab.id as id, eq.nome as equipamento, pd.nome as produto, ab.quantidade as quantidade, ab.data as data ')
                ->where('eq.nome',  'like', '%' . $request->filtro_equipamento . '%')->orderBy('data','desc')->paginate(12);
        } else {
            $abastecimentos = DB::table('abastecimentos as ab')
                ->join('equipamentos as eq', 'eq.id', '=', 'ab.equipamento_id')
                ->join('produtos as pd', 'pd.id', '=', 'ab.produto_id')
                ->selectRaw('ab.id as id, eq.nome as equipamento, pd.nome as produto, 
                ab.quantidade as quantidade, ab.data as data ')->orderBy('data','desc')->paginate(12);
        }


        return view('app.abastecimento.index', ['abastecimentos' => $abastecimentos,
         'equipamentos' => $equipamentos, 'request' => $request->all(),
        'filtro_equipamento'=>$filtro_equipamento
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipamentos = Equipamento::orderBy('nome', 'asc')->get();
        $produtos = Produto::orderBy('nome', 'asc')->get();
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

        $controle = Equipamento::find($request->equipamento_id);
        $controle_consumo = $controle->controle_consumo;
        $controle_saida = $controle->controle_saida;

        if ($controle_consumo == 1) {
            $consumo= new Consumo();
            $consumo->equipamento_id= $request->equipamento_id;
            $consumo->produto_id= $request->produto_id;
            $consumo->quantidade= $request->quantidade;
            $consumo->data= $request->data;
            $consumo->save();
            $request['consumo_id']=$consumo->id;
        } else {
            $equipamento = Equipamento::find($request->equipamento_id);
            $equipamento->quant_tanque = $equipamento->quant_tanque + $request->quantidade;
            $equipamento->save();
        }
        
        if ($controle_saida == 0) {
            $saida_produto = new SaidaProduto();
            $saida_produto->equipamento_id = $request->equipamento_id;
            $saida_produto->produto_id = $request->produto_id;
            $saida_produto->quantidade = $request->quantidade;
            $saida_produto->motivo = '1';
            $saida_produto->data = $request->data;
            $saida_produto->consumo_id=$consumo->id;
            $saida_produto->save();

            $produto = Produto::find($request->produto_id);
            $produto->estoque_atual = $produto->estoque_atual - $request->quantidade; // soma estoque antigo com a entrada de produto
            $produto->save();
        }


        Abastecimento::create($request->all());


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
    public function edit(Abastecimento $abastecimento)
    {
        $equipamentos=Equipamento::orderBy('nome', 'asc')->get();
        $produtos=Produto::orderBy('nome', 'asc')->get();
        return view('app.abastecimento.edit', ['abastecimento'=>$abastecimento, 'equipamentos'=>$equipamentos, 'produtos'=>$produtos]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Abastecimento $abastecimento)
    {
        $controle = Equipamento::find($request->equipamento_id);
        $controle_consumo = $controle->controle_consumo;
        $controle_saida = $controle->controle_saida;

        if ($controle_consumo == 1) {
            $consumo=Consumo::find($abastecimento->consumo_id);
            $consumo->equipamento_id= $request->equipamento_id;
            $consumo->produto_id= $request->produto_id;
            $consumo->quantidade= $request->quantidade;
            $consumo->data= $request->data;
            $consumo->save();
        } else {
            $equipamento = Equipamento::find($request->equipamento_id);
            $equipamento->quant_tanque = $equipamento->quant_tanque + $request->quantidade;
            $equipamento->save();
        }
        
        if ($controle_saida == 0) {
                        
            $saida_produto = SaidaProduto::where('consumo_id', $consumo->id);

            $diferenca_atualizada=$request->quantidade - $saida_produto->quantidade;
            $produto = Produto::find($request->produto_id);
            $produto->estoque_atual = $produto->estoque_atual + $request->quantidade; // soma estoque antigo com a entrada de produto
            $produto->save();

            $saida_produto->equipamento_id = $request->equipamento_id;
            $saida_produto->produto_id = $request->produto_id;
            $saida_produto->quantidade = $request->quantidade;
            $saida_produto->motivo = '1';
            $saida_produto->data = $request->data;
            $saida_produto->save();

        }

        $abastecimento->update($request->all());

        return redirect()->route('abastecimento.index');
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

    public function pdfExport($equipamento=''){
        if ($equipamento <>'') {
            $abastecimentos = DB::table('abastecimentos as ab')
                ->join('equipamentos as eq', 'eq.id', '=', 'ab.equipamento_id')
                ->join('produtos as pd', 'pd.id', '=', 'ab.produto_id')
                ->selectRaw('ab.id as id, eq.nome as equipamento, pd.nome as produto, ab.quantidade as quantidade, ab.data as data ')
                ->where('eq.nome',  'like', '%' . $equipamento . '%')->get();
        } else {
            $abastecimentos = DB::table('abastecimentos as ab')
                ->join('equipamentos as eq', 'eq.id', '=', 'ab.equipamento_id')
                ->join('produtos as pd', 'pd.id', '=', 'ab.produto_id')
                ->selectRaw('ab.id as id, eq.nome as equipamento, pd.nome as produto, ab.quantidade as quantidade, ab.data as data ')->get();
        }

        $total_quant=$abastecimentos->sum('quantidade');

        $pdf = PDF::loadView('app.abastecimento.exporta_pdf', ['abastecimentos' => $abastecimentos, 'total_quant'=>$total_quant]);
        return $pdf->stream('Abastecimentos.pdf');
    }
}
