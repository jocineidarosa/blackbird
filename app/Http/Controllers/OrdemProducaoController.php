<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\OrdemProducao;
use App\Models\Equipamento;
use App\Models\ParadaEquipamento;
use App\Models\RecursosProducao;
use App\Models\Status;
use App\Models\SaidaProduto;
use Carbon\Carbon;
use App\Models\Obra;
use App\Models\ProdutoObra;
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
        $statuss = Status::all();
        $obras = Obra::all();
        return view(
            'app.ordem_producao.abas',
            [
                'produtos' => $produtos,
                'equipamentos' => $equipamentos,
                'statuss' => $statuss,
                'obras' => $obras
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

        $regras = [
            'equipamento_id' => 'required',
            'produto_id' => 'required',
            'quantidade_producao' => 'required',
            'data' => 'required',
            'hora_inicio' => 'required',
            'hora_fim' => 'required',
            'horimetro_final' => 'required',
            'status_id' => 'required'
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido'
        ];

        $request->validate($regras, $feedback);

        $produtos = Produto::all();
        $equipamentos = Equipamento::all();
        $statuss = Status::all();
        $obras = Obra::all();
        $exists_ordem = OrdemProducao::where('data', $request['data'])
            ->where('equipamento_id', $request['equipamento_id'])->first();

        if (!isset($exists_ordem)) {
            $ordem_producao = OrdemProducao::create($request->all());
        } else {
            $ordem_producao = $exists_ordem;
        }
        return view(
            'app.ordem_producao.abas',
            [
                'produtos' => $produtos,
                'equipamentos' => $equipamentos,
                'ordem_producao' => $ordem_producao,
                'statuss' => $statuss,
                'obras' => $obras
            ]
        );
    }

    public function storeRecursos(Request $request, OrdemProducao $ordem_producao)
    {
        $produtos = Produto::all();
        $equipamentos = Equipamento::all();
        $statuss = Status::all();
        $obras=Obra::all();
        $paradas_equipamento = ParadaEquipamento::where('ordem_producao_id', $ordem_producao->id)->get();

        //$ordem_producao= OrdemProducao::find($ordem_producao);
        $exists_recurso_producao = RecursosProducao::where('ordem_producao_id', $ordem_producao->id)
            ->where('equipamento_id', $request['equipamento_id'])
            ->where('produto_id', $request['produto_id'])->first();

        if (!isset($exists_recurso_producao)) { //verifica re o recurso já existe na ordem se já, não deixa cadastrar.
            //salva recursos de produção no banco de dados
            $request['ordem_producao_id'] = $ordem_producao->id; //adiciona mais um ítem no Array '$request'.
            $request['equipamento_id']= $request['equipamento_recursos'];
            unset($request['equipamento_recursos']);
            $recurso_producao = RecursosProducao::create($request->all());

            $saida_produto = new SaidaProduto();
            $saida_produto->produto_id = $request->input('produto_id');
            $saida_produto->recursos_producao_id = $recurso_producao->id;
            $saida_produto->quantidade = $request->input('quantidade');
            $saida_produto->motivo = '1';
            $saida_produto->data = $request['data'];
            $saida_produto->save();

            $produto = Produto::find($request->input('produto_id'));
            $produto->estoque_atual = $produto->estoque_atual - $request->input('quantidade'); // soma estoque antigo com a entrada de produto
            $produto->save();
        }

        $recursos_producao = RecursosProducao::where('ordem_producao_id', $ordem_producao->id)->get();
        return view(
            'app.ordem_producao.abas',
            [
                'produtos' => $produtos,
                'equipamentos' => $equipamentos,
                'ordem_producao' => $ordem_producao,
                'recursos_producao' => $recursos_producao,
                'paradas_equipamento' => $paradas_equipamento,
                'statuss' => $statuss,
                'obras'=>$obras
            ]
        );
    }

    public function storeParadas(Request $request, OrdemProducao $ordem_producao)
    {
        $produtos = Produto::all();
        $equipamentos = Equipamento::all();
        $statuss = Status::all();
        $obras=Obra::all();
        $recursos_producao = RecursosProducao::where('ordem_producao_id', $ordem_producao->id)->get();

        if (($request['hora_inicio'] >= $ordem_producao->hora_inicio) 
        and ($request['hora_fim'] <= $ordem_producao->hora_fim)
        and($request['hora_inicio'] < $request['hora_fim'] )) {

            $exists_parada = ParadaEquipamento::where('ordem_producao_id', $ordem_producao->id)
                ->whereBetWeen('hora_inicio', [$request['hora_inicio'], $request['hora_fim']])
                ->orwhere('ordem_producao_id', $ordem_producao->id)
                ->WhereBetween('hora_fim', [$request['hora_inicio'], $request['hora_fim']])
                ->orwhere('ordem_producao_id', $ordem_producao->id)
                ->Where('hora_inicio', '<', $request['hora_inicio'])
                ->where('hora_fim', '>', $request['hora_fim'])->first();

            if (!isset($exists_parada)) {
                $request['ordem_producao_id'] = $ordem_producao->id;
                ParadaEquipamento::create($request->all());
            }
        }

        $paradas_equipamento = ParadaEquipamento::where('ordem_producao_id', $ordem_producao->id)->get();
        return view(
            'app.ordem_producao.abas',
            [
                'produtos' => $produtos,
                'equipamentos' => $equipamentos,
                'ordem_producao' => $ordem_producao,
                'recursos_producao' => $recursos_producao,
                'paradas_equipamento' => $paradas_equipamento,
                'statuss' => $statuss,
                'obras'=>$obras
            ]
        );
    }

    public function storeProdutoObra(Request $request, OrdemProducao $ordem_producao)
    {
        $produtos = Produto::all();
        $equipamentos = Equipamento::all();
        $statuss = Status::all();
        $obras = Obra::all();
        $recursos_producao = RecursosProducao::where('ordem_producao_id', $ordem_producao->id)->get();
        $paradas_equipamento = ParadaEquipamento::where('ordem_producao_id', $ordem_producao->id)->get();
        $request['ordem_producao_id'] = $ordem_producao->id;
        $exists_produto_obra = ProdutoObra::where('ordem_producao_id', $ordem_producao->id)
            ->where('produto_id', $request['produto_id'])
            ->where('obra_id', $request['obra_id'])->first();
        if (!isset($exists_produto_obra)) {
            ProdutoObra::create($request->all());
        }

        $produtos_obra = ProdutoObra::where('ordem_producao_id', $ordem_producao->id)->get();
        return view(
            'app.ordem_producao.abas',
            [
                'produtos' => $produtos,
                'equipamentos' => $equipamentos,
                'recursos_producao' => $recursos_producao,
                'ordem_producao' => $ordem_producao,
                'paradas_equipamento' => $paradas_equipamento,
                'statuss' => $statuss,
                'obras' => $obras,
                'produtos_obra' => $produtos_obra
            ]
        );
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

        if ($op_horimetro_inicial->horimetro_inicial == null) {
            $op_horimetro_inicial = $ordem_producao->horimetro_final;
            $total_horimetro = 0.0;
        } else {
            $op_horimetro_inicial = $op_horimetro_inicial->horimetro_inicial;
            $total_horimetro =  $ordem_producao->horimetro_final - $op_horimetro_inicial;
        }


        $hora_inicio = Carbon::createFromDate($ordem_producao->hora_inicio); //formata hora do carbon
        $hora_fim = Carbon::createFromDate($ordem_producao->hora_fim); //formata hora do carbon
        $hours = $hora_fim->diffInHours($hora_inicio); //recebe a diferença em horas sem minutos
        $minutes = ($hora_fim->diffInMinutes($hora_inicio)) % 60; //recebe o total em minutos e pega o resto da divisão por 60
        $total_horas_equipamento = $hours . ':' . $minutes; // concatena horas e minutos com os ':'

        /* $total_minutos = $hora_fim->diffInMinutes($hora_inicio); */
        if ($total_horimetro > 0) {
            $producao_por_hora = round($ordem_producao->quantidade_producao / $total_horimetro);
        } else {
            $producao_por_hora = '';
        }


        /**
         * manipulação da collection de recursos de produtos
         */

        /* 'sec_to_time(TIMESTAMPDIFF(SECOND,rp.hora_inicio, rp.hora_fim)) 
            as total_hora */

        $recursos_producao = DB::table('recursos_producao as rp')
            ->join('equipamentos as eq', 'eq.id', '=', 'rp.equipamento_id')
            ->join('produtos as p', 'p.id', '=', 'rp.produto_id')
            ->selectRaw('rp.*, eq.nome as equipamento, p.nome as produto')
            ->where('ordem_producao_id', $ordem_producao->id)->get();

        //adiciona horimetro_inicial, total_horimetro na collection
        foreach ($recursos_producao as $recurso) {
            $hora_inicio = Carbon::createFromDate($recurso->hora_inicio); //formata hora do carbon
            $hora_fim = Carbon::createFromDate($recurso->hora_fim); //formata hora do carbon
            $hours = $hora_fim->diffInHours($hora_inicio); //recebe a diferença em horas sem minutos
            $minutes = ($hora_fim->diffInMinutes($hora_inicio)) % 60; //recebe o total em minutos e pega o resto da divisão por 60
            $recurso->total_hora = $hours . ':' . $minutes; // concatena horas e minutos com os ':'

            if (($recurso->horimetro_final != null) and ($recurso->horimetro_final != 0)) { //VERIFICA SE O EQUIPAMENTO TEM HORÍMETRO
                $horimetro_inicial = DB::table('recursos_producao')->selectRaw(' max(horimetro_final) as horimetro_inicial')
                    ->where('equipamento_id', $recurso->equipamento_id)
                    ->where('horimetro_final', '<', $recurso->horimetro_final)->first();
                $recurso->horimetro_inicial = $horimetro_inicial->horimetro_inicial;
                $recurso->total_horimetro = round($recurso->horimetro_final - $recurso->horimetro_inicial, 2);
                $recurso->consumo_hora = $recurso->quantidade / $recurso->total_horimetro;
            } else { //CASO O EQUIPMENTO NÃO TENHA HORÍMETRO
                $recurso->horimetro_inicial = '';
                $recurso->total_horimetro = '';
                if ($total_horimetro > 0) {
                    $recurso->consumo_hora = round($recurso->quantidade / $total_horimetro, 2);
                } else {
                    $recurso->consumo_hora = 0.0;
                }
            }
            $recurso->consumo_quant = $recurso->quantidade / $ordem_producao->quantidade_producao * 1000;

            $estoque = Produto::select('estoque_atual')
                ->where('id', $recurso->produto_id)->first();
            $recurso->estoque_atual = $estoque->estoque_atual;
            $recurso->estoque_anterior = $recurso->estoque_atual + $recurso->quantidade;
        }

        $paradas = ParadaEquipamento::where('ordem_producao_id', $ordem_producao->id)->get();
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
