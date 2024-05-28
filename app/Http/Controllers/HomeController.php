<?php

namespace App\Http\Controllers;

use App\Models\OrdemProducao;
use App\Models\Produto;
/* use App\Models\RecursosProducao;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; */
use Illuminate\Support\Facades\DB;

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
        $last_production = OrdemProducao::where('data', $last_data_production)->first();
        $recursos = Produto::whereIn('id', [1, 2, 13, 147])->get();
        foreach ($recursos as $recurso) {
            $recurso->percent_estoque = round($recurso->estoque_atual / $recurso->estoque_maximo * 100, 0);
            $recurso->estoque_util = $recurso->estoque_atual - $recurso->lastro;
            $recurso->estoque_maximo = $recurso->estoque_maximo;
            $recurso->estoque_atual = $recurso->estoque_atual;
            $recurso->nome_prod = $recurso->nome;
            $recurso->autonomia = round($recurso->estoque_util / $recurso->teor_consumo);
        }


        /* $producoes = DB::table('producao_britagem')
        ->select(DB::raw('DATE_FORMAT(data,"%d/%m/%Y") as data'), 'producao_po')
        ->orderBy('id',  'desc')->limit(300)
        ->get();

        $labels = $producoes->pluck('data')->toArray();
        $data = $producoes->pluck('producao_po')->toArray();

        $chartData = [
            'labels' => $labels,
            'data' => $data
        ];

 */


        // Buscar a data do último dia registrado
        $ultimaData = DB::table('producao_britagem')
            ->select(DB::raw('DATE(data) as data'))
            ->orderByDesc('data')
            ->first()
            ->data;

        // Buscar os dados do último dia
        $producoes = DB::table('producao_britagem')
            ->select(DB::raw('TIME(hora) as hora'), 'producao_po')
            ->whereDate('data', $ultimaData)
            ->orderBy('data')
            ->get();

        // Preparar os dados para o gráfico
        $labels = $producoes->pluck('hora')->toArray();
        $data = $producoes->pluck('producao_pedrisco')->toArray();

        $chartData = [
            'labels' => $labels,
            'data' => $data,
            'dataTitulo' => $ultimaData
        ];
        return view('app.layouts.dashboard', ['recursos' => $recursos, 'chartData' => $chartData]);
        //return ('chegameos aqui');
    }
}
