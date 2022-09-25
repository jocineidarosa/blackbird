<?php

namespace App\Http\Controllers;

use App\Models\OrdemProducao;
use App\Models\Produto;
use App\Models\RecursosProducao;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $last_data_production=OrdemProducao::max('data');
        $last_production=OrdemProducao::where('data',$last_data_production)->first();
        $recursos= RecursosProducao::where('ordem_producao_id', $last_production->id)->where('quantidade', '>', 1)->get();
        foreach($recursos as $recurso){
            $estoque= Produto::find($recurso->produto_id);
            $recurso->percent_estoque = round($estoque->estoque_atual / $estoque->estoque_maximo * 100 , 0);
            $recurso->estoque_util= $estoque->estoque_atual - $estoque->lastro;
            $teor= $recurso->quantidade / $last_production->quantidade_producao;
            $recurso->estoque_maximo= $estoque->estoque_maximo;
            $recurso->teor=$teor;
            $recurso->estoque_atual= $estoque->estoque_atual;
            $recurso->nome_prod= $recurso->produto->nome;
            $recurso->autonomia= round($recurso->estoque_util / $teor);
        }

     /*    $estoque_produtos = Produto::whereIn('id', [1, 2, 13])->get();
        foreach ($estoque_produtos as $estoque) {
            $estoque->percent_estoque = $estoque->estoque_atual / $estoque->estoque_maximo * 100;
            $estoque->percent_estoque= round($estoque->percent_estoque,0);
            $estoque->estoque_util= $estoque->estoque_atual - $estoque->lastro;
            $estoque->autonomia= round($estoque->estoque_util / 0.053 , 0);
        } */
        return view('app.layouts.dashboard', ['recursos' => $recursos]);
        //return ('chegameos aqui');
    }
}
