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
use App\Exports\AbastecimentoExcelExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AbastecimentoImport;
use Illuminate\Support\Collection;
use Http;
use Maatwebsite\Excel\Concerns\ToCollection;

class AbastecimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $regras = [
            'data_final' => 'required_with:data_inicial',
            'data_inicial' => 'required_with:data_final'
        ];
        $feedback = [
            'required_with' => 'O campo :attribute deve ser preenchido'
        ];
        $request->validate($regras, $feedback);

        $filtros = '';
        $equipamentos = Equipamento::all();
        $abastecimentos = DB::table('abastecimentos as ab')
            ->join('equipamentos as eq', 'eq.id', '=', 'ab.equipamento_id')
            ->join('produtos as pd', 'pd.id', '=', 'ab.produto_id')
            ->selectRaw('ab.id as id, eq.nome as equipamento, pd.nome as produto, 
        ab.quantidade as quantidade, ab.data as data ');

        if ($request->filtro_equipamento) {
            $filtros = '?filtro_equipamento=' . $request->filtro_quipamento;
            $abastecimentos = $abastecimentos->where('eq.nome', 'like', '%' . $request->filtro_equipamento . '%');
        }
        if ($request->equipamento_id) {
            $filtros = '?equipamento_id=' . $request->equipamento_id;
            $abastecimentos = $abastecimentos->where('ab.equipamento_id', $request->equipamento_id);
        }
        if ($request->produto_id) {
            $filtros = strlen($filtros) > 0 ? $filtros . '&produto_id=' . $request->produto_id : '?produto_id=' . $request->produto_id;
            $abastecimentos = $abastecimentos->where('ab.produto_id', $request->produto_id);
        }
        if ($request->data_inicial) {
            $filtros = strlen($filtros) > 0 ? $filtros . '&data_inicial=' . $request->data_inicial . '&data_final=' . $request->data_final :
                '?data_inicial=' . $request->data_inicial . '&data_final=' . $request->data_final;
            $abastecimentos = $abastecimentos->whereBetween('data', [$request->data_inicial, $request->data_final]);
        }

        $abastecimentos = $abastecimentos->orderBy('data', 'desc')->paginate(12);

        return view('app.abastecimento.index', [
            'abastecimentos' => $abastecimentos,
            'equipamentos' => $equipamentos, 'request' => $request->all(),
            'filtros' => $filtros
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
        return view('app.abastecimento.create', [
            'equipamentos' => $equipamentos,
            'produtos' => $produtos
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
        $regras = [
            'equipamento_id' => 'required',
            'produto_id' => 'required',
            'data' => 'required',
            'quantidade' => 'required'
        ];
        $feedback = [
            'required_with' => 'O campo :attribute deve ser preenchido',
            'required' => 'Este campo não pode ficar em branco'
        ];
        $request->validate($regras, $feedback);

        $controle = Equipamento::find($request->equipamento_id);
        $controle_consumo = $controle->controle_consumo;
        $controle_saida = $controle->controle_saida;

        $abastecimento = Abastecimento::create($request->all());

        if ($controle_consumo == 1) {
            $consumo = new Consumo();
            $consumo->equipamento_id = $request->equipamento_id;
            $consumo->produto_id = $request->produto_id;
            $consumo->quantidade = $request->quantidade;
            $consumo->data = $request->data;
            $consumo->abastecimento_id = $abastecimento->id;
            $consumo->save();
            $request['consumo_id'] = $consumo->id;
        } else {
            $equipamento = Equipamento::find($request->equipamento_id);
            $equipamento->quant_tanque = $equipamento->quant_tanque + $request->quantidade;
            $equipamento->save();
        }
        ##################################################################
        //caso o controle de saida for 0, a cada abastecimento gera uma saida
        if ($controle_saida == 0) {
            $saida_produto = new SaidaProduto();
            $saida_produto->equipamento_id = $request->equipamento_id;
            $saida_produto->produto_id = $request->produto_id;
            $saida_produto->quantidade = $request->quantidade;
            $saida_produto->motivo = '1';
            $saida_produto->data = $request->data;
            $saida_produto->abastecimento_id = $abastecimento->id;
            $saida_produto->save();
            $produto = Produto::find($request->produto_id);
            $produto->estoque_atual = $produto->estoque_atual - $request->quantidade; // desconta quantidade do estoque de produto.
            $produto->save();
        }


        return redirect()->route('abastecimento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Abastecimento $abastecimento)
    {
        if (isset($abastecimento->horimetro)) {
            $horimetro_inicial = DB::table('abastecimentos')->selectRaw('max(horimetro) as horimetro_inicial')
                ->where('horimetro', '<', $abastecimento->horimetro)
                ->where('equipamento_id', $abastecimento->equipamento_id)->first();
            $horimetro_inicial = $horimetro_inicial->horimetro_inicial;
            $total_horimetro = round($abastecimento->horimetro - $horimetro_inicial, 2);
            $abastecimento->horimetro_inicial = $horimetro_inicial;
        } else {
            $total_horimetro = '';
        }

        if (isset($abastecimento->medidor_final)) {
            $medidor_inicial = DB::table('abastecimentos')->selectRaw('max(medidor_final) as medidor_inicial')
                ->where('medidor_final', '<', $abastecimento->medidor_final)
                ->where('produto_id', $abastecimento->produto_id)->first();
            $abastecimento->medidor_inicial = $medidor_inicial->medidor_inicial;
        }

        return view('app.abastecimento.show', ['abastecimento' => $abastecimento, 'total_horimetro' => $total_horimetro]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Abastecimento $abastecimento)
    {
        $equipamentos = Equipamento::orderBy('nome', 'asc')->get();
        $produtos = Produto::orderBy('nome', 'asc')->get();
        //dd($abastecimento);
        if (isset($abastecimento->horimetro)) {
            $horimetro_inicial = DB::table('abastecimentos')->selectRaw('max(horimetro) as horimetro_inicial')
                ->where('horimetro', '<', $abastecimento->horimetro)
                ->where('equipamento_id', $abastecimento->equipamento_id)->first();
            $horimetro_inicial = $horimetro_inicial->horimetro_inicial;
            $total_horimetro = round($abastecimento->horimetro - $horimetro_inicial, 2);
            $abastecimento->horimetro_inicial = $horimetro_inicial;
        } else {
            $total_horimetro = '';
        }

        if (isset($abastecimento->medidor_final)) {
            $medidor_inicial = DB::table('abastecimentos')->selectRaw('max(medidor_final) as medidor_inicial')
                ->where('medidor_final', '<', $abastecimento->medidor_final)
                ->where('produto_id', $abastecimento->produto_id)->first();
            $abastecimento->medidor_inicial = $medidor_inicial->medidor_inicial;
        }
        return view('app.abastecimento.edit', [
            'abastecimento' => $abastecimento,
            'equipamentos' => $equipamentos,
            'produtos' => $produtos,
            'total_horimetro' => $total_horimetro
        ]);
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
        $equipamento = Equipamento::find($abastecimento->equipamento_id);
        $controle_consumo = $equipamento->controle_consumo;
        $controle_saida = $equipamento->controle_saida;
        $dif_quant = $abastecimento->quantidade - $request->quantidade; //diferença entre quantidade antiga e quantidade nova no request.
        if ($controle_consumo == 1) {
            $consumo = Consumo::where('abastecimento_id', $abastecimento->id)->first();
            $consumo->produto_id = $request->produto_id;
            $consumo->quantidade = $request->quantidade;
            $consumo->data = $request->data;
            $consumo->save();
        } else {
            $equipamento->quant_tanque = $equipamento->quant_tanque - $dif_quant;
            $equipamento->save();
        }

        if ($controle_saida == 0) {
            $saida_produto = SaidaProduto::where('abastecimento_id', $abastecimento->id)->first();
            $produto = Produto::find($abastecimento->produto_id);
            $produto->estoque_atual = $produto->estoque_atual - $dif_quant; // atualiza o estoque do produto
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
    public function destroy(Request $request)
    {
        $abastecimento = Abastecimento::find($request->data_id);
        $equipamento = Equipamento::find($abastecimento->equipamento_id);
        $produto = Produto::find($abastecimento->produto_id);
        $controle_consumo = $equipamento->controle_consumo;
        $controle_saida = $equipamento->controle_saida;

        $saida_produto = SaidaProduto::where('abastecimento_id', $abastecimento->id)->first();
        if (isset($saida_produto)) {
            //atualiza estoque do produto.
            $produto->estoque_atual = $produto->estoque_atual + $abastecimento->quantidade;
            $produto->save();
            $saida_produto->delete(); //deleta saída
        }
        if ($controle_consumo == 0) {
            $equipamento->quant_tanque = $equipamento->quant_tanque - $abastecimento->quantidade;
            $equipamento->save();
        }

        //atualiza estoque e tanque do equipamento
        $consumo = Consumo::where('abastecimento_id', $abastecimento->id)->first();
        if (isset($consumo)) {
            $consumo->delete(); //deleta consumo
        }
        $abastecimento->delete(); //deleta abastecimento

        return redirect()->route('abastecimento.index');
    }

    public function pdfExport(Request $request)
    {
        $filtros = '';
        $abastecimentos = DB::table('abastecimentos as ab')
            ->join('equipamentos as eq', 'eq.id', '=', 'ab.equipamento_id')
            ->join('produtos as pd', 'pd.id', '=', 'ab.produto_id')
            ->selectRaw('ab.id as id, eq.nome as equipamento, pd.nome as produto, 
        ab.quantidade as quantidade, ab.data as data ');

        if ($request->filtro_equipamento) {
            $filtros = '?filtro_equipamento=' . $request->filtro_quipamento;
            $abastecimentos = $abastecimentos->where('eq.nome', 'like', '%' . $request->filtro_equipamento . '%');
        }
        if ($request->equipamento_id) {
            $filtros = '?equipamento_id=' . $request->equipamento_id;
            $abastecimentos = $abastecimentos->where('ab.equipamento_id', $request->equipamento_id);
        }
        if ($request->produto_id) {
            $filtros = strlen($filtros) > 0 ? $filtros . '&produto_id=' . $request->produto_id : '?produto_id=' . $request->produto_id;
            $abastecimentos = $abastecimentos->where('ab.produto_id', $request->produto_id);
        }
        if ($request->data_inicial) {
            $filtros = strlen($filtros) > 0 ? $filtros . '&data_inicial=' . $request->data_inicial . '&data_final=' . $request->data_final :
                '?data_inicial=' . $request->data_inicial . '&data_final=' . $request->data_final;
            $abastecimentos = $abastecimentos->whereBetween('data', [$request->data_inicial, $request->data_final]);
        }

        $abastecimentos = $abastecimentos->orderBy('data', 'desc')->get();

        $total_quant = $abastecimentos->sum('quantidade');

        $pdf = PDF::loadView('app.abastecimento.exporta_pdf', ['abastecimentos' => $abastecimentos, 'total_quant' => $total_quant]);
        return $pdf->stream('Abastecimentos.pdf');
    }

    public function getEstoqueAtual(Request $request)
    {
        $table = $request->get('table');
        $produto_id = $request->get('produto_id');
        $estoque_atual = DB::table($table)->selectRaw('estoque_atual')
            ->where('id', $produto_id)->first();

        //echo json_encode($estoque_final->quantidade);
        return response()->json(['estoque_atual' => $estoque_atual->estoque_atual]);
    }

    public function consultaAvancada()
    {
        $equipamentos = Equipamento::orderBy('nome', 'asc')->get();
        $produtos = Produto::orderBy('nome', 'asc')->get();
        return view('app.abastecimento.consulta_avancada', ['equipamentos' => $equipamentos, 'produtos' => $produtos]);
    }

    public function getContadorInicialProduto(Request $request)
    {
        $table = $request->get('table');
        $produto_id = $request->get('produto_id');
        $max_id =  DB::table($table)->selectRaw('max(id) as max_id')
            ->where('produto_id', $produto_id)->first();
        $max_id = $max_id->max_id;
        $contador_inicial = DB::table($table)->selectRaw('medidor_final')->where('id', $max_id)->first();

        echo json_encode($contador_inicial->medidor_final);
    }

    public function getHorimetroInicial(Request $request)
    {
        $equipamento = $request->equipamento_id;
        $data = $request->data;
        $lastData = DB::table('abastecimentos')->selectRaw('max(data) as data')
            ->where('data', '<=', $data)
            ->where('equipamento_id', $equipamento)->first();
        $horimetro_inicial = DB::table('abastecimentos')->selectRaw('horimetro')
            ->where('equipamento_id', $equipamento)
            ->where('data', $lastData->data)->first();
        return json_encode($horimetro_inicial->horimetro);
    }

    public function exportExcel(Request $request)
    {
        $filtros = '';
        $file_name = 'DBMAXIS BRESOLA - ABASTECIMENTOS';
        $abastecimentos = DB::table('abastecimentos as ab')
            ->join('equipamentos as eq', 'eq.id', '=', 'ab.equipamento_id')
            ->join('produtos as pd', 'pd.id', '=', 'ab.produto_id')
            ->selectRaw('ab.id as id, eq.nome as equipamento, pd.nome as produto, 
        ab.quantidade as quantidade, ab.data as data, ab.medidor_inicial as medidor_inicial, ab.medidor_final as medidor_final, ab.horimetro, ab.hora ');


        if ($request->filtro_equipamento) {
            $filtros = '?filtro_equipamento=' . $request->filtro_quipamento;
            $abastecimentos = $abastecimentos->where('eq.nome', 'like', '%' . $request->filtro_equipamento . '%');
        }
        if ($request->equipamento_id) {
            $filtros = '?equipamento_id=' . $request->equipamento_id;
            $abastecimentos = $abastecimentos->where('ab.equipamento_id', $request->equipamento_id);
            $file_name = $file_name .' - '. strtoupper(Equipamento::find($request->equipamento_id)->nome);
        }
        if ($request->produto_id) {
            $filtros = strlen($filtros) > 0 ? $filtros . '&produto_id=' . $request->produto_id : '?produto_id=' . $request->produto_id;
            $abastecimentos = $abastecimentos->where('ab.produto_id', $request->produto_id);
        }

        if ($request->data_inicial) {
            $filtros = strlen($filtros) > 0 ? $filtros . '&data_inicial=' . $request->data_inicial . '&data_final=' . $request->data_final :
                '?data_inicial=' . $request->data_inicial . '&data_final=' . $request->data_final;
            $abastecimentos = $abastecimentos->whereBetween('data', [$request->data_inicial, $request->data_final]);
            $file_name = $file_name .' DE '. date('d-m-Y',strtotime($request->data_inicial)) . ' a ' . date('d-m-Y', strtotime($request->data_final));
        }


        $abastecimentos = $abastecimentos->orderBy('data', 'asc')->get();

        $total_quant = $abastecimentos->sum('quantidade');

        return Excel::download(new AbastecimentoExcelExport($abastecimentos, $total_quant), $file_name . '.xlsx');
    }

    public function importExcel(Request $request)
    {
        Excel::import(new AbastecimentoImport, request()->file('file'));
        return redirect('abastecimentos.index');
        $abastecimentos = (new AbastecimentoImport)->toArray($request->file('file'));
    }

    public function searchExcel()
    {
        return view('app.abastecimento.search_excel');
    }
}
