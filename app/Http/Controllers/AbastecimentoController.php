<?php

namespace App\Http\Controllers;

use App\Models\Abastecimento;
use App\Models\Equipamento;
use App\Models\Produto;
use Illuminate\Http\Request;

class AbastecimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $equipamentos=Equipamento::all();
        if($request->filtro_equipamento){
            $abastecimentos=Abastecimento::where('equipamento_id', $request->filtro_equipamento)->paginate(12);
        }else{
           $abastecimentos=Abastecimento::orderBy('data', 'asc')->paginate(12); 
        }
        
        return view('app.abastecimento.index', ['abastecimentos'=>$abastecimentos, 'equipamentos'=>$equipamentos,'request'=>$request->all()] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipamentos=Equipamento::all();
        $produtos=Produto::all();
        return view('app.abastecimento.create',['equipamentos'=>$equipamentos, 'produtos'=>$produtos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Abastecimento::create($request->all());
        return redirect()->route('abastecimento.index');
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
        //
    }
}
