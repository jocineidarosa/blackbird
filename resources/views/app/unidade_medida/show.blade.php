
@extends('app.layouts.app')

@section('titulo', 'Produtos')

@section('content')

<main class="content">
    <div class="card">
        <div class="card-header-template">
            <div>Visualizar Unidade de Medida</div>
            <div>
                <a href="{{ route('unidade-medida.index') }}" class="btn btn-sm btn-primary">
                    LISTAGEM
                </a>
            </div>
        </div>

        
        <div class="card-body">
            <table class="table-template table-hover">
            <tr>
                <td class="text-right pr-5">ID</td>
                <td>{{$unidade_medida->id}}</td>
            </tr>
            <tr>
                <td class="text-right pr-5">Nome</td>
                <td>{{$unidade_medida->nome}}</td>
            </tr>
            <tr>
                <td class="text-right pr-5">Descrição</td>
                <td>{{$unidade_medida->descricao}}</td>
            </tr>
          
        </table>
        </div>
    </div>

</main>

@endsection




