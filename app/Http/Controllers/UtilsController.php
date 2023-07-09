<?php

namespace App\Http\Controllers;

use App\Models\Abastecimento;
use App\Models\Cidade;
use App\Models\Consumo;
use App\Models\EntradaProduto;
use App\Models\Equipamento;
use App\Models\OrdemProducao;
use App\Models\RecursosProducao;
use App\Models\SaidaProduto;
use Illuminate\Support\Facades\DB;
use PDF;


use Illuminate\Http\Request;

class UtilsController extends Controller
{

    public function getHorimetroInicial(Request $request)
    {
        $table = $request->get('table');
        $field= $request->get('field');
        $equipamento_id = $request->get('equipamento_id');
        $horimetro_inicial = DB::table($table)->selectRaw('max('.$field.') as horimetro_inicial')
            ->where('equipamento_id', $equipamento_id)->first();
        echo json_encode($horimetro_inicial->horimetro_inicial);
    }

    public function getEstoqueFinal(Request $request)
    {
        $table = $request->get('table');
        $equipamento_id = $request->get('equipamento_id');
        $medida_final = $request->get('medida_final');
        $estoque_final = DB::table($table)->selectRaw('quantidade')
            ->where('equipamento_id', $equipamento_id)
            ->where('medida', $medida_final)->first();

        //echo json_encode($estoque_final->quantidade);
        return response()->json(['estoque_final' => $estoque_final->quantidade]);
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


    //busca o estoque do tanque de cobustivel do equipamento
    public function getQuantTanque(Request $request)
    {
        $table = $request->get('table');
        $equipamento_id = $request->get('equipamento_id');
        $quant_tanque = DB::table($table)->selectRaw('quant_tanque')
            ->where('id', $equipamento_id)->first();

        //echo json_encode($estoque_final->quantidade);
        return response()->json(['quant_tanque' => $quant_tanque->quant_tanque]);
    }


    public function getCidade(Request $request)
    {
        $uf = $request->get('uf');
        $cidades = Cidade::orderBy('nome', 'asc')->where('uf_id', $uf)->get();
        return json_encode($cidades);
        //return response()->json(['cidades'=>$cidades]);
    }

    public function getHorimetroInicialByData(Request $request)
    {
        $equipamento=$request->equipamento_id;
        $data=$request->data;

        $lastData = DB::table('abastecimentos')->selectRaw('max(data) as data')
        ->where('data', '<=', $data)
        ->where('equipamento_id', $equipamento)->first();

        $horimetro_inicial=DB::table('abastecimentos')->selectRaw('horimetro')
        ->where('equipamento_id', $equipamento)
        ->where('data', $lastData->data)->first();

        return json_encode($horimetro_inicial->horimetro);

    }


}
