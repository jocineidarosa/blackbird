<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use App\Models\Manutencao;
use App\Models\Manutentor;

class ManutencaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->descricao){
            $manutencoes=Manutencao::where('descricao', 'like','%'. $request->descricao . '%')->paginate(12);
        }else{
           $manutencoes=Manutencao::orderBy('data_inicio', 'asc')->paginate(12); 
        }
        
        return view('app.manutencao.index', ['manutencoes'=>$manutencoes, 'request'=>$request->all()] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipamentos= Equipamento::all();
        $funcionarios= Funcionario::all();
        return view('app.manutencao.create', ['equipamentos'=>$equipamentos, 'funcionarios'=>$funcionarios]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $manutencao=Manutencao::create($request->all());
        foreach($request->selected_maintainers as $maintainer){
            Manutentor::create(['manutencao_id'=>$manutencao->id,
                                'funcionario_id'=>$maintainer, 
                                'data_inicio'=>$request->data_inicio,
                                'hora_inicio'=>$request->hora_inicio,
                                'data_fim'=>$request->data_fim,
                                'hora_fim'=>$request->hora_fim
        ]);

        return redirect()->route('manutencao.index');

        }

        return redirect()->route('manutencao.index');
   
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
