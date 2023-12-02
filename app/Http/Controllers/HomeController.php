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
        $recursos= Produto::whereIn('id',[1,2,13,147])->get();
        foreach($recursos as $recurso){
            $recurso->percent_estoque = round($recurso->estoque_atual / $recurso->estoque_maximo * 100 , 0);
            $recurso->estoque_util=$recurso->estoque_atual - $recurso->lastro;
            $recurso->estoque_maximo= $recurso->estoque_maximo;
            $recurso->estoque_atual= $recurso->estoque_atual;
            $recurso->nome_prod= $recurso->nome;
            $recurso->autonomia= round($recurso->estoque_util/ $recurso->teor_consumo);
        }
        return view('app.layouts.dashboard', ['recursos' => $recursos]);
        //return ('chegameos aqui');
    }
}
