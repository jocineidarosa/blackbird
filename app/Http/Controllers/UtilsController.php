<?php

namespace App\Http\Controllers;
use App\Models\OrdemProducao;
use App\Models\RecursosProducao;
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


    public function getHorimetroInicialRecursos(Request $request){
        $equipamento_id = $request->get('equipamento_id');
        $horimetro_inicial=RecursosProducao::where('equipamento_id', $equipamento_id)->orderBy('id', 'desc')->first();
        $horimetro_inicial=$horimetro_inicial->horimetro_final;
        echo json_encode($horimetro_inicial);

    }
}
