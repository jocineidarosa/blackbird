<?php

namespace App\Http\Controllers;

use App\Models\Pesagem;
use App\Http\Requests\StorePesagemRequest;
use Illuminate\Http\Request;

class PesagemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pesagens = Pesagem::orderBy('id', 'desc')->paginate(12);
        foreach ($pesagens as $pesagem) {
            if ($pesagem->situacao == 'CO') {
                $pesagem->situacao = 'COMPLETO';
            } else if ($pesagem->situacao == 'CA') {
                $pesagem->situacao = 'CANCELADO';
            } else if ($pesagem->situacao == 'ED') {
                $pesagem->situacao = 'EDITADO';
            }else if ($pesagem->situacao == 'IN') {
                $pesagem->situacao = 'INCOMPLETO';
            } else if ($pesagem->situacao == 'MA') {
                $pesagem->situacao = 'MANUAL';
            }
        }
        return view('app.pesagem.index', ['pesagens' => $pesagens, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePesagemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePesagemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pesagem  $pesagem
     * @return \Illuminate\Http\Response
     */
    public function show(Pesagem $pesagem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pesagem  $pesagem
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesagem $pesagem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePesagemRequest  $request
     * @param  \App\Models\Pesagem  $pesagem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesagem $pesagem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pesagem  $pesagem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesagem $pesagem)
    {
        //
    }
}
