<?php

namespace App\Http\Controllers;

use App\Models\Pesagem;
use App\Http\Requests\StorePesagemRequest;
use App\Models\Motorista;
use App\Models\Produto;
use App\Models\Parceiro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PesagemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $regras = [
            'data_final' => 'required_with:data_inicial',
            'data_inicial' => 'required_with:data_final'
        ];
        $feedback = [
            'required_with' => 'O campo :attribute deve ser preenchido'
        ];
        $request->validate($regras, $feedback);

        $filtros = '';
        $pesagens = DB::table('pesagens as ps')
            ->join('parceiros as pc', 'ps.parceiro_id', '=', 'pc.id')
            ->join('produtos as pd', 'ps.produto_id', '=', 'pd.id')
            ->join('motoristas_ as mt', 'ps.motorista_id', '=', 'mt.id')
            ->selectRaw('ps.*, pc.nome as parceiro, pd.nome as produto, mt.nome as motorista');

        if ($request->filtro_motorista) {
            $filtros = '?filtro_motorista=' . $request->filtro_motorista;
            $pesagens = $pesagens->where('mt.nome', 'like', '%' . $request->filtro_motorista . '%');
        }
        if ($request->parceiro_id) {
            $filtros = '?parceiro_id=' . $request->parceiro_id;
            $pesagens = $pesagens->where('ps.parceiro_id', $request->parceiro_id);
        }
        if ($request->produto_id) {
            $filtros = strlen($filtros) > 0 ? $filtros . '&produto_id=' . $request->produto_id : '?produto_id=' . $request->produto_id;
            $pesagens = $pesagens->where('ps.produto_id', $request->produto_id);
        }
        if ($request->motorista_id) {
            $filtros = strlen($filtros) > 0 ? $filtros . '&motorista_id=' . $request->motorista_id : '?motorista_id=' . $request->motorista_id;
            $pesagens = $pesagens->where('ps.motorista_id', $request->motorista_id);
        }
        if ($request->data_inicial) {
            $filtros = strlen($filtros) > 0 ? $filtros . '&data_inicial=' . $request->data_inicial . '&data_final=' . $request->data_final :
                '?data_inicial=' . $request->data_inicial . '&data_final=' . $request->data_final;
            $pesagens = $pesagens->whereBetween('data', [$request->data_inicial, $request->data_final]);
        }

        $pesagens = $pesagens->orderBy('data', 'desc')->paginate(12);

        foreach ($pesagens as $pesagem) {
            if ($pesagem->situacao == 'CO') {
                $pesagem->situacao = 'COMPLETO';
            } else if ($pesagem->situacao == 'CA') {
                $pesagem->situacao = 'CANCELADO';
            } else if ($pesagem->situacao == 'ED') {
                $pesagem->situacao = 'EDITADO';
            } else if ($pesagem->situacao == 'IN') {
                $pesagem->situacao = 'INCOMPLETO';
            } else if ($pesagem->situacao == 'MA') {
                $pesagem->situacao = 'MANUAL';
            }
        }



        return view('app.pesagem.index', [
            'pesagens' => $pesagens,
            'request' => $request->all(),
            'filtros' => $filtros
        ]);



        //$pesagens = Pesagem::orderBy('id', 'desc')->paginate(12);

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
    public function show(Pesagem $pesagem, Request $request)
    {
        $quant_impress = (int)$request->quant_impress;
        return view('app.pesagem.ticket', ['pesagem' => $pesagem, 'quant_impress' => $quant_impress]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pesagem  $pesagem
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesagem $pesagem)
    {
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

    public function consultaAvancada()
    {

        $parceiros = Parceiro::orderBy('nome', 'asc')->get();
        $produtos = Produto::orderBy('nome', 'asc')->get();
        $motoristas = Motorista::orderBy('nome', 'asc')->get();
        return view(
            'app.pesagem.consulta_avancada',
            [
                'parceiros' => $parceiros,
                'produtos' => $produtos,
                'motoristas' => $motoristas
            ]
        );
    }

    public function pdfExport(Request $request)
    {
        
        $filtros = '';
        $pesagens = DB::table('pesagens as ps')
            ->join('parceiros as pc', 'ps.parceiro_id', '=', 'pc.id')
            ->join('produtos as pd', 'ps.produto_id', '=', 'pd.id')
            ->join('motoristas_ as mt', 'ps.motorista_id', '=', 'mt.id')
            ->selectRaw('ps.*, pc.nome as parceiro, pd.nome as produto, mt.nome as motorista');

        if ($request->filtro_motorista) {
            $filtros = '?filtro_motorista=' . $request->filtro_motorista;
            $pesagens = $pesagens->where('mt.nome', 'like', '%' . $request->filtro_motorista . '%');
        }
        if ($request->parceiro_id) {
            $filtros = '?parceiro_id=' . $request->parceiro_id;
            $pesagens = $pesagens->where('ps.parceiro_id', $request->parceiro_id);
        }
        if ($request->produto_id) {
            $filtros = strlen($filtros) > 0 ? $filtros . '&produto_id=' . $request->produto_id : '?produto_id=' . $request->produto_id;
            $pesagens = $pesagens->where('ps.produto_id', $request->produto_id);
        }
        if ($request->motorista_id) {
            $filtros = strlen($filtros) > 0 ? $filtros . '&motorista_id=' . $request->motorista_id : '?motorista_id=' . $request->motorista_id;
            $pesagens = $pesagens->where('ps.motorista_id', $request->motorista_id);
        }
        if ($request->data_inicial) {
            $filtros = strlen($filtros) > 0 ? $filtros . '&data_inicial=' . $request->data_inicial . '&data_final=' . $request->data_final :
                '?data_inicial=' . $request->data_inicial . '&data_final=' . $request->data_final;
            $pesagens = $pesagens->whereBetween('data', [$request->data_inicial, $request->data_final]);
        }

        $pesagens = $pesagens->orderBy('data', 'desc')->get();

        foreach ($pesagens as $pesagem) {
            if ($pesagem->situacao == 'CO') {
                $pesagem->situacao = 'COMPLETO';
            } else if ($pesagem->situacao == 'CA') {
                $pesagem->situacao = 'CANCELADO';
            } else if ($pesagem->situacao == 'ED') {
                $pesagem->situacao = 'EDITADO';
            } else if ($pesagem->situacao == 'IN') {
                $pesagem->situacao = 'INCOMPLETO';
            } else if ($pesagem->situacao == 'MA') {
                $pesagem->situacao = 'MANUAL';
            }
        }


        $pdf = PDF::loadView('app.pesagem.export_pdf', ['pesagens' => $pesagens,]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Relatório de Pesagem.pdf');
    }

}
