<?php

namespace App\Http\Controllers;

use App\Models\OrdemProducao;
use App\Models\ProducaoBritagem;
use App\Models\Produto;
/* use App\Models\RecursosProducao;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; */
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use function PHPUnit\Framework\isEmpty;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //essa function controla a autenticação da view 'home'
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {



        $last_data_production = OrdemProducao::max('data');
        //$last_production = OrdemProducao::where('data', $last_data_production)->first();
        $recursos = Produto::whereIn('id', [1, 2, 13, 147])->get();
        foreach ($recursos as $recurso) {
            $recurso->percent_estoque = round($recurso->estoque_atual / $recurso->estoque_maximo * 100, 0);
            $recurso->estoque_util = $recurso->estoque_atual - $recurso->lastro;
            $recurso->estoque_maximo = $recurso->estoque_maximo;
            $recurso->estoque_atual = $recurso->estoque_atual;
            $recurso->nome_prod = $recurso->nome;
            $recurso->autonomia = round($recurso->estoque_util / $recurso->teor_consumo);
        }


        $Producao_britagem = ProducaoBritagem::orderBy('id', 'desc')->first();
        // Pegar o valor do horímetro parcial desse registro

        $dataAtual = Carbon::now()->format('Y-m-d'); // Formato: 2024-06-18
        //$dataAtual='2024-06-23';

        $producao_inicial = ProducaoBritagem::where('data', $dataAtual)->limit(1)->orderBy('id', 'asc')->first();

            
        if(isset($producao_inicial)) {
            $producao_diaria_po = $Producao_britagem->po - $producao_inicial->po;
            $producao_diaria_pedrisco = $Producao_britagem->pedrisco - $producao_inicial->pedrisco;
            $producao_diaria_pedra34 = $Producao_britagem->pedra32 - $producao_inicial->pedra34;
            $producao_diaria_pedra2 = $Producao_britagem->pedra2 - $producao_inicial->pedra2;
        }else{
            $producao_diaria_po = 0;
            $producao_diaria_pedrisco = 0;
            $producao_diaria_pedra34 = 0;
            $producao_diaria_pedra2 = 0;
        }





        /* 
        // Buscar a data do último dia registrado
        $ultimaData = DB::table('producao_britagem')
            ->select(DB::raw('DATE(data) as data'))
            ->orderByDesc('data')
            ->first()
            ->data;

        $subquery = DB::table('producao_britagem')
            ->select(DB::raw('TIME(hora) as hora'), 'producao_po', 'id')  // Inclua 'id' para ordenar posteriormente
            ->whereDate('data', $ultimaData)
            ->orderBy('id', 'desc')
            ->limit(1000);

        // Em seguida, faça uma consulta principal para ordenar esses resultados em ordem crescente pelo id
        $producoes = DB::table(DB::raw("({$subquery->toSql()}) as sub"))
            ->mergeBindings($subquery)  // Merge bindings é necessário para subconsultas
            ->orderBy('id', 'asc')
            ->get();



        // Preparar os dados para o gráfico
        $labels = $producoes->pluck('hora')->toArray();
        $data = $producoes->pluck('producao_po')->toArray();



        $chartData = [
            'labels' => $labels,
            'data' => $data,
            'dataTitulo' => $ultimaData
        ]; */

        // Fetch the last recorded date
        $ultimaData = DB::table('producao_britagem')
            ->select(DB::raw('DATE(data) as data'))
            ->orderByDesc('data')
            ->first()
            ->data;

        // Subquery to fetch records from the last recorded date with interval filtering
        $subquery = DB::table('producao_britagem')
            ->select(DB::raw('TIME(hora) as hora'), 'producao_po', 'id')  // Include 'id' for ordering
            ->whereDate('data', $ultimaData)
            ->whereRaw('MOD(id, 20  ) = 0')  // Select every 20th record
            ->orderBy('id', 'asc');  // Ascending order is fine directly here

        // Execute the query and get the results
        $producoes = $subquery->get();

        // Prepare the data for the chart
        $labels = $producoes->pluck('hora')->toArray();
        $data = $producoes->pluck('producao_po')->toArray();

        $chartData = [
            'labels' => $labels,
            'data' => $data,
            'dataTitulo' => $ultimaData
        ];


        return view('app.layouts.dashboard', [
            'recursos' => $recursos,
            'chartData' => $chartData,
            'producao_britagem' => $Producao_britagem,
            'producao_diaria_po' => $producao_diaria_po,
            'producao_diaria_pedrisco' => $producao_diaria_pedrisco,
            'producao_diaria_pedra34' => $producao_diaria_pedra34,
            'producao_diaria_pedra2' => $producao_diaria_pedra2,

        ]);
        //return ('chegameos aqui');
    }


    //***Pega os dados via ajax */
    /*     function getChartData()
    {

        // Buscar a data do último dia registrado
        $ultimaData = DB::table('producao_britagem')
            ->select(DB::raw('DATE(data) as data'))
            ->orderByDesc('data')
            ->first()
            ->data;

        $subquery = DB::table('producao_britagem')
            ->select(DB::raw('TIME(hora) as hora'), 'producao_po', 'id')  // Inclua 'id' para ordenar posteriormente
            ->whereDate('data', $ultimaData)
            ->orderBy('id', 'desc')
            ->limit(10000);

        // Em seguida, faça uma consulta principal para ordenar esses resultados em ordem crescente pelo id
        $producoes = DB::table(DB::raw("({$subquery->toSql()}) as sub"))
            ->mergeBindings($subquery)  // Merge bindings é necessário para subconsultas
            ->orderBy('id', 'asc')
            ->get();



        // Preparar os dados para o gráfico
        $labels = $producoes->pluck('hora')->toArray();
        $data = $producoes->pluck('producao_po')->toArray();



        $chartData = [
            'labels' => $labels,
            'data' => $data,
            'dataTitulo' => $ultimaData
        ];

        return response()->json($chartData);
    } */

    function getChartData()
    {
        // Fetch the last recorded date
        $ultimaData = DB::table('producao_britagem')
            ->select(DB::raw('DATE(data) as data'))
            ->orderByDesc('data')
            ->first()
            ->data;

        // Subquery to fetch records from the last recorded date with interval filtering
        $subquery = DB::table('producao_britagem')
            ->select(DB::raw('TIME(hora) as hora'), 'producao_po', 'id')  // Include 'id' for ordering
            ->whereDate('data', $ultimaData)
            ->whereRaw('MOD(id, 20  ) = 0')  // Select every 20th record
            ->orderBy('id', 'asc');  // Ascending order is fine directly here

        // Execute the query and get the results
        $producoes = $subquery->get();

        // Prepare the data for the chart
        $labels = $producoes->pluck('hora')->toArray();
        $data = $producoes->pluck('producao_po')->toArray();

        $chartData = [
            'labels' => $labels,
            'data' => $data,
            'dataTitulo' => $ultimaData
        ];

        return response()->json($chartData);
    }
}
