@extends('app.layouts.app')

@section('titulo', 'Produtos')

@section('content')

    <div class="card">
        <div class="card-header-template">
            <div>VISUALIZAR ENTRADA DE PRODUTO</div>
            <div>
                <a href="{{route('entrada-produto.index')}}" class="btn btn-sm btn-primary">
                    LISTAGEM
                </a>
    
                <a href="{{route('entrada-produto.create')}}" class="btn btn-sm btn-primary">
                    NOVO
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">
            <tr>
                <td class="text-right pr-5">ID</td>
                <td>{{$entrada_produto->id}}</td>
            </tr>
            <tr>
                <td class="text-right pr-5">PRODUTO</td>
                <td>{{$entrada_produto->produto_id}}</td>
            </tr>
            <tr>
                <td class="text-right pr-5">FORNECEDOR</td>
                <td>{{$entrada_produto->fornecedor_id}}</td>
            </tr>
            <tr>
                <td class="text-right pr-5"> QUANTIDADE</td>
                <td>{{$entrada_produto->quantidade}}</td>
            </tr>
            <tr>
                <td class="text-right pr-5">NOTA FISCAL</td>
                <td>{{$entrada_produto->nota_fiscal}}</td>
            </tr>
            <tr>
                <td class="text-right pr-5">DATA</td>
                <td>{{$entrada_produto->data}}</td>
            </tr>
        </table>
        </div>
    </div>

@endsection




