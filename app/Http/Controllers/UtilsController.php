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
        $equipamento_id = $request->get('equipamento_id');
        $horimetro_inicial = DB::table($table)->selectRaw(' max(horimetro_final) as horimetro_inicial')
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


    public function criaConsumo()
    {

        $maxcode = DB::table('saidas_produtos')->selectRaw('max(id) as max')->first();
        $maxcode = $maxcode->max;

        $saidas = [];

        for ($i = 1; $i <= $maxcode; $i++) {

            $saidaOk = SaidaProduto::where('id', $i)->where('recursos_producao_id', '<>', null)->first();
            if (isset($saidaOk)) {
                $equipamento = RecursosProducao::find($saidaOk->recursos_producao_id);
                $equipamento = $equipamento->equipamento_id;
                $consumo = new Consumo();
                $consumo->recurso_producao_id = $saidaOk->recursos_producao_id;
                $consumo->equipamento_id = $equipamento;
                $consumo->produto_id = $saidaOk->produto_id;
                $consumo->quantidade = $saidaOk->quantidade;
                $consumo->data = $saidaOk->data;
                $consumo->save();
            }
        }
    }

    public function modificaEntradaDiesel()
    {
        $entradas_produto = EntradaProduto::where('data', '<', '2022-11-15')->where('produto_id', 2)->get();
        foreach ($entradas_produto as $entrada) {
            $entrada->equipamento_id = 7;
            $entrada->save();
        }
    }
    
    public function modificaEntradaCap()
    {
        $entradas_produto = EntradaProduto::where('produto_id', 1)->get();
        foreach ($entradas_produto as $entrada) {
            $entrada->equipamento_id = 8;
            $entrada->save();
        }
    }

    public function modificaEntradaComb()
    {
        $entradas_produto = EntradaProduto::where('produto_id', 13)->orWhere('produto_id', 9)->orWhere('produto_id', 3)->get();
        foreach ($entradas_produto as $entrada) {
            $entrada->equipamento_id = 10;
            $entrada->save();
        }
    }

    public function addAbastDiesel(){
        $entrada_diesel= EntradaProduto::where('data', '>=', '2022-11-15')->where('produto_id', 2)->get();

        foreach($entrada_diesel as $entrada){
            $abast=new Abastecimento();
            $abast->equipamento_id=7;
            $abast->produto_id=2;
            $abast->quantidade=$entrada->quantidade;
            $abast->data=$entrada->data;
            $abast->save();
        }
    }

    public function deletaEntradaDiesel(){
        $entradas_diesel=EntradaProduto::where('data', '>=', '2022-11-15')->where('produto_id',2)->get();

        foreach($entradas_diesel as $entrada){
            $entrada->delete();
        }
    }

    public function executeChangeData(){
        $this->criaConsumo();
        $this->modificaEntradaDiesel();
        $this->modificaEntradaCap();
        $this->modificaEntradaComb();
        $this->addAbastDiesel();
        $this->deletaEntradaDiesel();
        echo'Executado com exito!';

    }

    public function export(){
        $abastecimentos=Abastecimento::all();
        $pdf = PDF::loadView('app.produto.teste', ['abastecimentos'=>$abastecimentos]);
        return $pdf->download('lista_de_tarefas.pdf');
        
    }
}
