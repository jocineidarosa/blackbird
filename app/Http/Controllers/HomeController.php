<?php

namespace App\Http\Controllers;

use App\Models\Produto;
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
        $estoque_produtos=Produto::whereIn('id',[1,2,3,9])->get();
        return view('app.layouts.dashboard',['estoque_produtos'=>$estoque_produtos]);
        //return ('chegameos aqui');
    }
}
