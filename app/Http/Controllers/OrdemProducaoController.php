<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\OrdemProducao;
use App\Models\Equipamento;
use App\Models\ParadaEquipamento;
use App\Models\RecursosProducao;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class OrdemProducaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::all();
        $ordens_producoes = OrdemProducao::all();

        return view('app.ordem_producao.index', ['produtos' => $produtos, 'ordens_producoes' => $ordens_producoes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produtos = Produto::all();
        $equipamentos = Equipamento::all();
        return view('app.ordem_producao.create', ['produtos' => $produtos, 'equipamentos' => $equipamentos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produtos = Produto::all();
        $equipamentos = Equipamento::all();

        $data_inicio = $request->input('data_inicio');
        $data_fim = $request->input('data_fim');
        $hora_inicio = $request->input('hora_inicio');
        $hora_fim = $request->input('hora_fim');
        //verifica se já existe registro com data_inicio, data_fim, hora_inicio, hora_fim.
        $exists_ordem = OrdemProducao::where('data_inicio', $data_inicio)->where('data_fim', $data_fim)->where('hora_inicio', $hora_inicio)->where('hora_fim', $hora_fim)->get()->first();

        if (isset($exists_ordem)) {
            $ordem_producao = OrdemProducao::find($request->session()->get('ordem_producao'));
            return view('app.ordem_producao.create', ['produtos' => $produtos, 'equipamentos' => $equipamentos, 'ordem_producao' => $ordem_producao]);
        }
        $ordem_producao = OrdemProducao::create($request->all());
        $request->session()->put('ordem_producao', $ordem_producao->id); //cria uam session com o id da ordem de produção
        return view('app.ordem_producao.create', ['produtos' => $produtos, 'equipamentos' => $equipamentos, 'ordem_producao' => $ordem_producao]);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\OrdemProducao $ordem_producao
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(OrdemProducao $ordem_producao)
    {
        $op_horimetro_inicial = DB::table('ordens_producoes')->selectRaw(' max(horimetro_final) as horimetro_inicial')
            ->where('equipamento_id', $ordem_producao->equipamento_id)
            ->where('horimetro_final', '<', $ordem_producao->horimetro_final)->first();
  
        if($op_horimetro_inicial->horimetro_inicial == null){
            $op_horimetro_inicial= $ordem_producao->horimetro_final;
            $total_horimetro = 0.0;
        }else{
            $op_horimetro_inicial=$op_horimetro_inicial->horimetro_inicial;
            $total_horimetro =  $ordem_producao->horimetro_final - $op_horimetro_inicial;
        }


        $hora_inicio = Carbon::createFromDate($ordem_producao->hora_inicio); //formata hora do carbon
        $hora_fim = Carbon::createFromDate($ordem_producao->hora_fim); //formata hora do carbon
        $hours = $hora_fim->diffInHours($hora_inicio); //recebe a diferença em horas sem minutos
        $minutes = ($hora_fim->diffInMinutes($hora_inicio)) % 60; //recebe o total em minutos e pega o resto da divisão por 60
        $total_horas_equipamento = $hours . ':' . $minutes; // concatena horas e minutos com os ':'

        $total_minutos = $hora_fim->diffInMinutes($hora_inicio);
        if($total_horimetro >0){
            $producao_por_hora = round($ordem_producao->quantidade_producao / $total_horimetro);
        }else{
            $producao_por_hora='';  
        }
        

        /**
         * manipulação da collection de recursos de produtos
         */
        $recursos_producao = DB::table('recursos_producao as rp')
            ->join('equipamentos as eq', 'eq.id', '=', 'rp.equipamento_id')
            ->join('produtos as p', 'p.id', '=', 'rp.produto_id')
            ->selectRaw('sec_to_time(TIMESTAMPDIFF(SECOND,rp.hora_inicio, rp.hora_fim)) 
            as total_hora, rp.*, eq.nome as equipamento, p.nome as produto')
            ->where('ordem_producao_id', $ordem_producao->id)->get();

        //adiciona horimetro_inicial, total_horimetro na collection
        foreach ($recursos_producao as $recurso) {
            if ($recurso->horimetro_final != null) { //VERIFICA SE O EQUIPAMENTO TEM HORÍMETRO
                $horimetro_inicial = DB::table('recursos_producao')->selectRaw(' max(horimetro_final) as horimetro_inicial')
                    ->where('equipamento_id', $recurso->equipamento_id)
                    ->where('horimetro_final', '<', $recurso->horimetro_final)->first();
                $recurso->horimetro_inicial = $horimetro_inicial->horimetro_inicial;
                $recurso->total_horimetro = round($recurso->horimetro_final - $recurso->horimetro_inicial, 2);
                $recurso->consumo_hora = $recurso->quantidade / $recurso->total_horimetro;
            } else { //CASO O EQUIPMENTO NÃO TENHA HORÍMETRO
                $recurso->horimetro_inicial = '';
                $recurso->total_horimetro = '';
                if($total_horimetro >0 ){
                    $recurso->consumo_hora = round($recurso->quantidade / $total_horimetro, 2);
                }else{
                    $recurso->consumo_hora=0.0;
                }
            }
            $recurso->consumo_quant= $recurso->quantidade / $ordem_producao->quantidade_producao *1000;

            $estoque = Produto::select('estoque_atual')
            ->where('id', $recurso->produto_id)->first();
            $recurso->estoque_atual= $estoque->estoque_atual;
            $recurso->estoque_anterior= $recurso->estoque_atual + $recurso->quantidade;
        }


        /* $paradas = ParadaEquipamento::where('ordem_producao_id', $ordem_producao->id)->get(); */

        $paradas = DB::table('paradas_equipamentos')
        ->selectRaw('*, sec_to_time(TIMESTAMPDIFF(SECOND, hora_inicio, hora_fim)) 
        as total_hora ')
        ->where('ordem_producao_id', $ordem_producao->id)->get();
        /* dd($paradas); */

        return view(
            'app.ordem_producao.show',
            [
                'ordem_producao' => $ordem_producao,
                'op_horimetro_inicial' => $op_horimetro_inicial,
                'paradas' => $paradas,
                'recursos_producao' => $recursos_producao,
                'total_horimetro' => $total_horimetro,
                'total_horas_equipamento' => $total_horas_equipamento,
                'producao_por_hora' => $producao_por_hora
            ]
        );
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

    public function getHorimetroInicial(Request $request)
    {
        $equipamento_id = $request->get('equipamento_id');
        $horimetro_inicial = OrdemProducao::where('equipamento_id', $equipamento_id)->orderBy('id', 'desc')->first();
        $horimetro_inicial = $horimetro_inicial->horimetro_final;
        echo json_encode($horimetro_inicial);
    }
}
