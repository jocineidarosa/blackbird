
@extends('app.layouts.app')

@section('titulo', 'Produtos')

@section('content')

    <div class="card">
        <div class="card-header-template">
            <div>VISUALIZAR SAÍDA DE PRODUTO</div>
            <div>
                <a href="{{route('saida-produto.index')}}" class="btn btn-sm btn-primary">
                    LISTAGEM
                </a>
                <a href="{{route('saida-produto.create')}}" class="btn btn-sm btn-primary">
                    NOVO
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">
            <tr>
                <td class="text-right pr-5">ID</td>
                <td>{{$saida_produto->id}}</td>
            </tr>
            <tr>
                <td class="text-right pr-5">Produto</td>
                <td>{{$saida_produto->produto->nome}}</td>
            </tr>
            <tr>
                <td class="text-right pr-5">quantidade</td>
                <td>{{$saida_produto->quantidade}}</td>
            </tr>
            <tr>
                <td class="text-right pr-5"> Motivo</td>
                <td>{{$saida_produto->motivo_saida->motivo}}</td>
            </tr>
            <tr>
                <td class="text-right pr-5">Data</td>
                <td>{{$saida_produto->data}}</td>
            </tr>
            <tr>
                <td class="text-right pr-5">Observação</td>
                <td>{{$saida_produto->observacao}}</td>
            </tr>
        </table>
        </div>
    </div>


@endsection




