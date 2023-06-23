<?php

namespace App\Http\Controllers;

use App\Models\EntradaProduto;
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
use App\Models\Transportadora;
use Illuminate\Support\Facades\DB;
use App\Models\Consumo;

class OrdemProducaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $produtos = Produto::all();
        $ordens_producoes = OrdemProducao::where('quantidade_producao', '>', 0)->orderBy('data', 'desc')->paginate(12);
        $total_producao = OrdemProducao::where('quantidade_producao', '>', 0)->get()->sum('quantidade_producao');
        return view('app.ordem_producao.index', [
            'produtos' => $produtos,
            'ordens_producoes' => $ordens_producoes,
            'request' => $request->all(),
            'total_producao' => $total_producao
        ]);
    }

    public function editFilter()
    {
        $produtos = Produto::all();
        $equipamentos = Equipamento::all();
        return view('app.ordem_producao.filter', compact('produtos', 'equipamentos'));
    }

    public function filter(Request $request)
    {

        $regras = [
            'data_final' => 'required_with:data_inicial',
            'data_inicial' => 'required_with:data_final'
        ];
        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'required_with' => 'O campo :attribute deve ser preenchido'
        ];

        $request->validate($regras, $feedback);

        $ordens_producoes = OrdemProducao::orderBy('data');
        if ($request->data_inicial) {
            $ordens_producoes->whereBetween('data', [$request->data_inicial, $request->data_final]);
        }
        if ($request->equipamento_id) {
            $ordens_producoes->where('equipamento_id', $request->equipamento_id);
        }
        if ($request->produto_id) {
            $ordens_producoes->where('produto_id', $request->produto_id);
        }

        $ordens_producoes = $ordens_producoes->paginate(13);
        $total_producao = $ordens_producoes->sum('quantidade_producao');
        return view(
            'app.ordem_producao.index',
            [
                'ordens_producoes' => $ordens_producoes,
                'request' => $request->all(),
                'total_producao' => $total_producao
            ]
        );
    }

    public function editFilterResumo()
    {
        $obras = Obra::all();
        return view('app.ordem_producao.filer_resumo', ['obras' => $obras]);
    }

    public function filterResumo(Request $request)
    {
        $obra = $request->obra_id;
        $nome_obra = Obra::find($obra);
        $nome_obra = $nome_obra->nome;
        $obras = Obra::all();

        $total_producao = DB::table('produtos_obra')->selectRaw('sum(quantidade) as total_producao')
            ->where('obra_id', $obra)->first();
        $total_producao = $total_producao->total_producao;
        $total_producao_do_dia = DB::table('produtos_obra')->selectRaw('ordem_producao_id')
            ->where('obra_id', $obra)->get();

        $total_producao_do_dia_1 = 0;
        $total_prod_dia = 0;
        foreach ($total_producao_do_dia as $prod) {
            $total_producao_do_dia_1 = DB::table('ordens_producoes')->selectRaw('quantidade_producao')
                ->where('id', $prod->ordem_producao_id)->first();
            $total_prod_dia = $total_prod_dia + $total_producao_do_dia_1->quantidade_producao;
        }

        //dd($total_prod_dia);

        //dd($total_producao_do_dia);

        $resumo_producao = DB::table('obras as o')
            ->join('produtos_obra as po', 'o.id', '=', 'po.obra_id')
            ->join('ordens_producoes as op', 'po.ordem_producao_id', '=', 'op.id')
            ->join('recursos_producao as rp', 'op.id', '=', 'rp.ordem_producao_id')
            ->join('produtos as p', 'p.id', '=', 'rp.produto_id')
            ->select(DB::raw('sum(rp.quantidade) as total, p.nome as nome'))
            ->where('o.id', $obra)
            ->where('rp.quantidade', '>', 10) //gambiarra pra não aparecer energia elétrica
            ->groupBy('nome')->get();
        $v_total_obra = 0;

        foreach ($resumo_producao as $resumo) {
            //busca o preço do produto no banco de dados.
            $preco_produto = DB::table('entradas_produtos')
                ->select('preco')
                ->where('id', DB::raw('(SELECT max(ep.id) as cod FROM entradas_produtos ep
            inner join produtos p on p.id = ep.produto_id WHERE data <=( SELECT max(op.data) 
            as data FROM produtos_obra as po INNER JOIN ordens_producoes as op on 
            po.ordem_producao_id = op.id WHERE po.obra_id=' . $obra . ') and p.nome=' . '"' . $resumo->nome . '")'))->first();

            $resumo->preco = $preco_produto->preco; //adiciona o campo preco
            $resumo->teor = $resumo->total / $total_prod_dia;
            $resumo->total = $resumo->teor * $total_producao;
            $valor_total = $resumo->total * $preco_produto->preco; //calcula o valor total e grava na variavel $valor_total
            $resumo->v_total = $valor_total; //adiciona o campo v_total
            //$resumo->teor = $resumo->total / $total_producao * 1000; //calcula teor do consumo
            $resumo->teor = $resumo->teor * 1000;
            $v_total_obra = $v_total_obra + $valor_total;
        }

        return view(
            'app.ordem_producao.filer_resumo',
            [
                'resumo_producao' => $resumo_producao,
                'nome_obra' => $nome_obra,
                'obras' => $obras,
                'total_producao' => $total_producao,
                'v_total_obra' => $v_total_obra
            ]
        );
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
        $transportadoras = Transportadora::all();
        return view(
            'app.ordem_producao.create_edit',
            [
                'produtos' => $produtos,
                'equipamentos' => $equipamentos,
                'statuss' => $statuss,
                'obras' => $obras,
                'transportadoras' => $transportadoras
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
        $transportadoras = Transportadora::all();
        $exists_ordem = OrdemProducao::where('data', $request['data'])
            ->where('equipamento_id', $request['equipamento_id'])->first();

        if (!isset($exists_ordem)) {
            $ordem_producao = OrdemProducao::create($request->all());
        } else {
            $ordem_producao = $exists_ordem;
        }
        return view(
            'app.ordem_producao.create_edit',
            [
                'produtos' => $produtos,
                'equipamentos' => $equipamentos,
                'ordem_producao' => $ordem_producao,
                'statuss' => $statuss,
                'obras' => $obras,
                'transportadoras' => $transportadoras
            ]
        );
    }

    public function storeRecursos(Request $request, OrdemProducao $ordem_producao)
    {
        $produtos = Produto::all();
        $equipamentos = Equipamento::all();
        $statuss = Status::all();
        $obras = Obra::all();
        $transportadoras = Transportadora::all();
        $paradas_equipamento = ParadaEquipamento::where('ordem_producao_id', $ordem_producao->id)->get();
        $produtos_obra = ProdutoObra::where('ordem_producao_id', $ordem_producao->id)->get();

        //$ordem_producao= OrdemProducao::find($ordem_producao);
        $exists_recurso_producao = RecursosProducao::where('ordem_producao_id', $ordem_producao->id)
            ->where('equipamento_id', $request['equipamento_recursos'])
            ->where('produto_id', $request['produto_id'])->first();
        if (!isset($exists_recurso_producao)) { //verifica re o recurso já existe na ordem se já, não deixa cadastrar.
            //salva recursos de produção no banco de dados
            $request['ordem_producao_id'] = $ordem_producao->id; //adiciona mais um ítem no Array '$request'.
            $request['equipamento_id'] = $request['equipamento_recursos'];
            unset($request['equipamento_recursos']); //apaga o campo equipamento_recurso, que é substituído por equipamento_id.
            $recurso_producao = RecursosProducao::create($request->all());

            //atualiza o estoque do tanque.
            $equipamento = Equipamento::find($request->equipamento_id);
            $equipamento->quant_tanque = $equipamento->quant_tanque - $request->quantidade;
            $equipamento->save();

            $consumo = new Consumo();
            $consumo->recurso_producao_id = $recurso_producao->id;
            $consumo->equipamento_id = $request->equipamento_id;
            $consumo->produto_id = $request->produto_id;
            $consumo->quantidade = $request->quantidade;
            $consumo->data = $request->data;
            $consumo->save();


            ### Caso o campo controle_saida de equipamentos seja 1 etão nessa etapa é gerada uma saíde de produto
            $controle_saida = Equipamento::find($request->equipamento_id);
            $controle_saida = $controle_saida->controle_saida;
            if ($controle_saida == 1) {
                $saida_produto = new SaidaProduto();
                $saida_produto->equipamento_id = $request->equipamento_id;
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
        }

        $recursos_producao = RecursosProducao::where('ordem_producao_id', $ordem_producao->id)->get();
        return view(
            'app.ordem_producao.create_edit',
            [
                'produtos' => $produtos,
                'equipamentos' => $equipamentos,
                'ordem_producao' => $ordem_producao,
                'recursos_producao' => $recursos_producao,
                'paradas_equipamento' => $paradas_equipamento,
                'produtos_obra' => $produtos_obra,
                'statuss' => $statuss,
                'obras' => $obras,
                'transportadoras' => $transportadoras,
                'tab_active' => 'recursos'
            ]
        );
    }

    public function storeParadas(Request $request, OrdemProducao $ordem_producao)
    {
        $produtos = Produto::all();
        $equipamentos = Equipamento::all();
        $statuss = Status::all();
        $obras = Obra::all();
        $transportadoras = Transportadora::all();
        $recursos_producao = RecursosProducao::where('ordem_producao_id', $ordem_producao->id)->get();
        $produtos_obra = ProdutoObra::where('ordem_producao_id', $ordem_producao->id)->get();

        if (($request['hora_inicio'] >= $ordem_producao->hora_inicio)
            and ($request['hora_fim'] <= $ordem_producao->hora_fim)
            and ($request['hora_inicio'] < $request['hora_fim'])
        ) {

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
            'app.ordem_producao.create_edit',
            [
                'produtos' => $produtos,
                'equipamentos' => $equipamentos,
                'ordem_producao' => $ordem_producao,
                'recursos_producao' => $recursos_producao,
                'paradas_equipamento' => $paradas_equipamento,
                'produtos_obra' => $produtos_obra,
                'statuss' => $statuss,
                'obras' => $obras,
                'transportadoras' => $transportadoras,
                'tab_active' => 'stop'
            ]
        );
    }

    public function storeProdutoObra(Request $request, OrdemProducao $ordem_producao)
    {
        $produtos = Produto::all();
        $equipamentos = Equipamento::all();
        $statuss = Status::all();
        $obras = Obra::all();
        $transportadoras = Transportadora::all();
        $recursos_producao = RecursosProducao::where('ordem_producao_id', $ordem_producao->id)->get();
        $paradas_equipamento = ParadaEquipamento::where('ordem_producao_id', $ordem_producao->id)->get();
        $request['ordem_producao_id'] = $ordem_producao->id;
        $exists_produto_obra = ProdutoObra::where('ordem_producao_id', $ordem_producao->id)
            ->where('produto_id', $request['produto_id'])
            ->where('obra_id', $request['obra_id'])->first();

        if (empty($exists_produto_obra)) {
            ProdutoObra::create($request->all());
        }

        $produtos_obra = ProdutoObra::where('ordem_producao_id', $ordem_producao->id)->get();
        return view(
            'app.ordem_producao.create_edit',
            [
                'produtos' => $produtos,
                'equipamentos' => $equipamentos,
                'recursos_producao' => $recursos_producao,
                'ordem_producao' => $ordem_producao,
                'paradas_equipamento' => $paradas_equipamento,
                'statuss' => $statuss,
                'obras' => $obras,
                'produtos_obra' => $produtos_obra,
                'transportadoras' => $transportadoras,
                'tab_active' => 'product'
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
        //horimetro inicial da ordem de operação
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

        $recursos_producao = DB::table('recursos_producao as rp')
            ->join('equipamentos as eq', 'eq.id', '=', 'rp.equipamento_id')
            ->join('produtos as p', 'p.id', '=', 'rp.produto_id')
            ->selectRaw('rp.*, eq.nome as equipamento, p.nome as produto')
            ->where('rp.ordem_producao_id', $ordem_producao->id)
            ->where('rp.quantidade', '>', 1)->get();

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
            /* soma quantidade total de entrada de produto até a data da ordem de produção 
            depois a saida de produto da mesma forma subtrai a saida da entrada*/
            $total_entrada_produto = EntradaProduto::where('data', '<=', $ordem_producao->data)
                ->where('produto_id', $recurso->produto_id)->get('quantidade');
            $total_entrada_produto = $total_entrada_produto->sum('quantidade');
            $total_saida_produto = SaidaProduto::where('data', '<=', $ordem_producao->data)
                ->where('produto_id', $recurso->produto_id)->get('quantidade');
            $total_saida_produto = $total_saida_produto->sum('quantidade');

            $recurso->estoque_final = $total_entrada_produto - $total_saida_produto;
            $recurso->estoque_anterior = $recurso->estoque_atual + $recurso->quantidade;
        }

        $paradas = ParadaEquipamento::where('ordem_producao_id', $ordem_producao->id)->get();
        foreach ($paradas as $parada) {
            /* aqui vai o codigo de paradas de equipamentos */
            $hora_inicio = Carbon::createFromDate($parada->hora_inicio); //formata hora do carbon
            $hora_fim = Carbon::createFromDate($parada->hora_fim); //formata hora do carbon
            $hours = $hora_fim->diffInHours($hora_inicio); //recebe a diferença em horas sem minutos
            $minutes = ($hora_fim->diffInMinutes($hora_inicio)) % 60; //recebe o total em minutos e pega o resto da divisão por 60
            $parada->total_hora = $hours . ':' . $minutes; // concatena horas e minutos com os ':'
        }

        $produtos_obra = ProdutoObra::where('ordem_producao_id', $ordem_producao->id)->get();

        return view(
            'app.ordem_producao.show',
            [
                'ordem_producao' => $ordem_producao,
                'op_horimetro_inicial' => $op_horimetro_inicial,
                'paradas' => $paradas,
                'produtos_obra' => $produtos_obra,
                'recursos_producao' => $recursos_producao,
                'total_horimetro' => $total_horimetro,
                'total_horas_equipamento' => $total_horas_equipamento,
                'producao_por_hora' => $producao_por_hora,
            ]
        );
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdemProducao $ordem_producao, $tab_active = '')
    {
        $produtos = Produto::all();
        $equipamentos = Equipamento::all();
        $statuss = Status::all();
        $obras = Obra::all();
        $transportadoras = Transportadora::all();
        $recurso_producao = RecursosProducao::where('ordem_producao_id', $ordem_producao->id)->get();
        $paradas_equipamento = ParadaEquipamento::where('ordem_producao_id', $ordem_producao->id)->get();
        $produtos_obra = ProdutoObra::where('ordem_producao_id', $ordem_producao->id)->get();
        return view(
            'app.ordem_producao.create_edit',
            [
                'produtos' => $produtos,
                'equipamentos' => $equipamentos,
                'statuss' => $statuss,
                'obras' => $obras,
                'transportadoras' => $transportadoras,
                'ordem_producao' => $ordem_producao,
                'recursos_producao' => $recurso_producao,
                'paradas_equipamento' => $paradas_equipamento,
                'produtos_obra' => $produtos_obra,
                'tab_active' => $tab_active

            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdemProducao $ordem_producao)
    {
        $ordem_producao->update($request->all());
        return redirect()->route('ordem-producao.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ordem_producao = OrdemProducao::find($request->data_id);
        $recurso_producao = RecursosProducao::where('ordem_producao_id', $ordem_producao->id)->get();

        foreach ($recurso_producao as $recurso) {
            $saida_produto = SaidaProduto::where('recursos_producao_id', $recurso->id)->first();
            if (!empty($saida_produto)) {
                $saida_produto->delete();
                $produto = Produto::find($saida_produto->produto_id);
                $produto->estoque_atual = $produto->estoque_atual + $saida_produto->quantidade;
                $produto->save();
            }

            $consumo=Consumo::where('recurso_producao_id', $recurso->id)->first();
            if(!empty($consumo)){
                $consumo->delete();
                $equipamento=Equipamento::find($recurso->equipamento_id);
                $equipamento->quant_tanque= $equipamento->quant_tanque + $recurso->quantidade;
                $equipamento->save();
            }
        }
        $recurso_producao = RecursosProducao::where('ordem_producao_id', $ordem_producao->id)->delete();
        $produto_obra = ProdutoObra::where('ordem_producao_id', $ordem_producao->id)->delete();
        $paradas_equipamento = ParadaEquipamento::where('ordem_producao_id', $ordem_producao->id)->delete();
        $ordem_producao->delete();
        return redirect()->route('ordem-producao.index');
    }

    public function destroyProdutoObra(ProdutoObra $produto_obra, OrdemProducao $ordem_producao)
    {
        $produto_obra->delete();
        return redirect()->route('ordem-producao.edit', ['ordem_producao' => $ordem_producao->id, 'tab_active' => 'product']);
    }

    public function destroyRecursoProducao(RecursosProducao $recurso_producao, OrdemProducao $ordem_producao)
    {
        $saida_produto = SaidaProduto::where('recursos_producao_id', $recurso_producao->id)->first();
        if (!empty($saida_produto)) {
            $saida_produto->delete();

            $produto = Produto::find($saida_produto->produto_id);
            $produto->estoque_atual = $produto->estoque_atual + $saida_produto->quantidade;
            $produto->save();
        }

        $consumo = Consumo::where('recurso_producao_id', $recurso_producao->id);
        $consumo->delete();

        $equipamento = Equipamento::find($recurso_producao->equipamento_id);
        $equipamento->quant_tanque = $equipamento->quant_tanque + $recurso_producao->quantidade;
        $equipamento->save();

        $recurso_producao->delete();
        return redirect()->route('ordem-producao.edit', ['ordem_producao' => $ordem_producao->id, 'tab_active' => 'recursos']);
    }

    public function destroyParadaEquipamento(ParadaEquipamento $parada_equipamento, OrdemProducao $ordem_producao)
    {

        $parada_equipamento->delete();
        return redirect()->route('ordem-producao.edit', ['ordem_producao' => $ordem_producao->id, 'tab_active' => 'stop']);
    }

    public function getHorimetroInicial(Request $request)
    {
        $equipamento_id = $request->get('equipamento_id');
        $horimetro_inicial = OrdemProducao::where('equipamento_id', $equipamento_id)->orderBy('id', 'desc')->first();
        $horimetro_inicial = $horimetro_inicial->horimetro_final;
        echo json_encode($horimetro_inicial);
    }
}
