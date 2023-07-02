<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Equipamento;
use App\Models\Produto;

class EquipamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->filtro_equipamento) {
            $equipamentos = Equipamento::where('nome', 'like', '%' . $request->filtro_equipamento . '%')->paginate(12);
        } else {
            $equipamentos = Equipamento::orderBy('nome', 'asc')->paginate(12);
        }
        return view(
            'app.equipamento.index',
            [
                'equipamentos' => $equipamentos,
                'request' => $request->all()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $marcas = Marca::all();
        $equipamentos = Equipamento::all();
        $produtos = Produto::all();
        return view('app.equipamento.create', ['marcas' => $marcas, 'equipamentos' => $equipamentos, 'produtos' => $produtos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Equipamento::create($request->all());
        return redirect()->route('equipamento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipamento  $equipamento
     * @return \Illuminate\Http\Response
     */
    public function show(Equipamento $equipamento)
    {
        return view('app.equipamento.show', ['equipamento' => $equipamento]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipamento  $equipamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipamento $equipamento)
    {
        $marcas = Marca::all();
        $equipamentos = Equipamento::all();
        $produtos = Produto::all();
        return view('app.equipamento.edit', [
            'equipamento' => $equipamento,
            'equipamentos' => $equipamentos, 'marcas' => $marcas, 'produtos' => $produtos
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipamento  $equipamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipamento $equipamento)
    {
        $equipamento->update($request->all());
        return redirect()->route('equipamento.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipamento  $equipamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipamento $equipamento)
    {
        $equipamento->delete();
        return redirect()->route('equipamento.index');
    }
}
