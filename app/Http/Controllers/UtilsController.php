<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\Consumo;
use App\Models\OrdemProducao;
use App\Models\RecursosProducao;
use App\Models\SaidaProduto;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UtilsController extends Controller
{

    public function getHorimetroInicial(Request $request){
        $table=$request->get('table');
        $equipamento_id = $request->get('equipamento_id');
        $horimetro_inicial= DB::table($table)->selectRaw(' max(horimetro_final) as horimetro_inicial')
        ->where('equipamento_id', $equipamento_id)->first();
        echo json_encode($horimetro_inicial->horimetro_inicial);
    }
    
    public function getEstoqueFinal(Request $request){
        $table=$request->get('table');
        $equipamento_id = $request->get('equipamento_id');
        $medida_final= $request->get('medida_final');
        $estoque_final= DB::table($table)->selectRaw('quantidade')
        ->where('equipamento_id', $equipamento_id)
        ->where('medida', $medida_final)->first();

        //echo json_encode($estoque_final->quantidade);
        return response()->json(['estoque_final'=>$estoque_final->quantidade]);
    }

    public function getEstoqueAtual(Request $request){
        $table=$request->get('table');
        $produto_id = $request->get('produto_id');
        $estoque_atual= DB::table($table)->selectRaw('estoque_atual')
        ->where('id', $produto_id)->first();

        //echo json_encode($estoque_final->quantidade);
        return response()->json(['estoque_atual'=>$estoque_atual->estoque_atual]);
    }


    //busca o estoque do tanque de cobustivel do equipamento
    public function getQuantTanque(Request $request){
        $table=$request->get('table');
        $equipamento_id = $request->get('equipamento_id');
        $quant_tanque= DB::table($table)->selectRaw('quant_tanque')
        ->where('id', $equipamento_id)->first();

        //echo json_encode($estoque_final->quantidade);
        return response()->json(['quant_tanque'=>$quant_tanque->quant_tanque]);
    }


    public function getCidade(Request $request){
        $uf = $request->get('uf');
        $cidades= Cidade::orderBy('nome', 'asc')->where('uf_id',$uf)->get();
        return json_encode($cidades);
        //return response()->json(['cidades'=>$cidades]);
    }


    public function criaConsumo(){

        $maxcode=DB::table('saidas_produtos')->selectRaw('max(id) as max')->first();
        $maxcode=$maxcode->max;

        $saidas=[];

        for($i=1; $i<=$maxcode; $i++){

            $saidaOk=SaidaProduto::where('id', $i)->where('recursos_producao_id', '<>' , null)->where('produto_id',1 )->first();
             if(isset($saidaOk)){
                $equipamento=RecursosProducao::find($saidaOk->recursos_producao_id);
                $equipamento=$equipamento->equipamento_id;
                $consumo= new Consumo();
                $consumo->recurso_producao_id= $saidaOk->recursos_producao_id;
                $consumo->equipamento_id= $equipamento;
                $consumo->produto_id= $saidaOk->produto_id;
                $consumo->quantidade= $saidaOk->quantidade;
                $consumo->data= $saidaOk->data; 
                $consumo->save(); 
            }   
            

        }

 
    }

}   
