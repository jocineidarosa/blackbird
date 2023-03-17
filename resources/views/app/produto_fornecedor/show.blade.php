
@extends('app.layouts.app')

@section('content')

    <div class="card">
        <div class="card-header-template">
            <div>EDITAR PRODUTO</div>
            <div>
                <a href="{{route('produto.index')}}" class="btn btn-sm btn-primary">
                    LISTAGEM
                </a>
    
                <a href="{{route('produto.create')}}" class="btn btn-sm btn-primary">
                    NOVO
                </a>
            </div>
        </div>


        <div class="card-body">
            <table class="table table-hover">
            <tr>
                <td>ID</td>
                <td>{{$produto->id}}</td>
            </tr>
            <tr>
                <td>Nome</td>
                <td>{{$produto->nome}}</td>
            </tr>
            <tr>
                <td>DESCRIÇÂO</td>
                <td>{{$produto->descricao}}</td>
            </tr>
            <tr>
                <td>MARCA</td>
                <td>{{$produto->marca->nome}}</td>
            </tr>
            <tr>
                <td>ESTOQUE MÍNIMO</td>
                <td>{{$produto->estoque_minimo}}</td>
            </tr>
            <tr>
                <td>ESTOQUE MÁXIMO</td>
                <td>{{$produto->estoque_maximo}}</td>
            </tr>
        </table>
        </div>
    </div>


@endsection




