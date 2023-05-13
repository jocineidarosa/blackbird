<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Produto;
use App\Models\ProdutoObra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoObraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $produtos_obra= DB::table('produtos_obra as po')
        ->join('ordens_producoes as op', 'op.id', '=', 'po.ordem_producao_id')
        ->join('produtos as p', 'p.id', '=', 'po.produto_id')
        ->join('obras as o', 'o.id', '=', 'po.obra_id')
        ->selectRaw('po.*, op.data, p.nome as produto, o.nome as obra')->orderBy('data', 'desc')->paginate(12);


        $total=DB::table('produtos_obra as po')
        ->join('ordens_producoes as op', 'op.id', '=', 'po.ordem_producao_id')
        ->join('produtos as p', 'p.id', '=', 'po.produto_id')
        ->join('obras as o', 'o.id', '=', 'po.obra_id')
        ->selectRaw('po.*')->get()->sum('quantidade');

        return view('app.saida_produto_obra.index', 
        ['produtos_obra'=>$produtos_obra, 'request'=>$request->all(), 'total'=>$total]);
    }

    public function editFilter(){
        $obras= Obra::all();
        $produtos= Produto::all();
        return view('app.saida_produto_obra.filter', compact('obras', 'produtos'));
    }  


    public function filter(Request $request){

         $regras = [
            'data_final' =>'required_with:data_inicial',
            'data_inicial' =>'required_with:data_final'
        ];
        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'required_with'=>'O campo :attribute deve ser preenchido'
        ];

        $request->validate($regras, $feedback);


        $produtos_obra= DB::table('produtos_obra as po')
        ->join('ordens_producoes as op', 'op.id', '=', 'po.ordem_producao_id')
        ->join('produtos as p', 'p.id', '=', 'po.produto_id')
        ->join('obras as o', 'o.id', '=', 'po.obra_id')
        ->selectRaw('po.*, op.data, p.nome as produto, o.nome as obra');

        if($request->data_inicial){
            $produtos_obra->whereBetween('op.data', [$request->data_inicial, $request->data_final]);
        }
        if($request->produto){
            $produtos_obra->where('produto_id', $request->produto);
        }
        if($request->obra){
            $produtos_obra->where('obra_id', $request->obra);
        }
        
        $total= $produtos_obra->get()->sum('quantidade');
        $produtos_obra=$produtos_obra->orderBy('data','desc')->paginate(13);
        
        return view('app.saida_produto_obra.index', 
        [
            'produtos_obra'=>$produtos_obra,
            'request'=>$request->all(),
            'total'=>$total
         ]);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
