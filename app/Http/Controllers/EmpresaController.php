<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Models\Cidade;


class EmpresaController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(Request $request)
   {
       $empresas=Empresa::orderBy('nome_fantasia')->paginate(12);

       return view('app.empresa.index', ['empresas'=>$empresas, 'request'=>$request->all()]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       $empresas=Empresa::all();
       $cicades=Cidade::all();
       return view('app.empresa.create', ['empresas'=>$empresas, 'cidades'=>$cicades]);
   
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
       Empresa::create($request->all());
       return redirect()->route('empresa.index');
   }

   /**
    * Display the specified resource.
    *
    * @param  \App\Fornecedor $fornecedor
    * @return \Illuminate\Http\Response
    */
   public function show(Empresa $fornecedor)
   {
       return view('app.empresa.show', ['fornecedor'=>$fornecedor]);
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Fornecedor $fornecedor
    * @return \Illuminate\Http\Response
    */
   public function edit(Empresa $fornecedor)
   {
       return view('app.empresa.edit', ['fornecedor'=>$fornecedor]);
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  App\Fornecedor $fornecedor
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request,Empresa $fornecedor)
   {
       $fornecedor->update($request->all());
       return redirect()->route('fornecedor.show', ['fornecedor'=>$fornecedor]);
   }

  
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Fornecedor  $fornecedor
    * @return \Illuminate\Http\Response
    */
   public function destroy(Empresa $fornecedor)
   {
       $fornecedor->delete();
       return redirect()->route('fornecedor.index');
   }
}

