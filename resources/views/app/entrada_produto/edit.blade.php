@extends('app.layouts.app')

@section('titulo', 'Produtos')

@section('content')

    <div class="card">
        <div class="card-header-template">
            <div>EDITAR ENTRADA DE PRODUTO</div>
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
            @component('app.entrada_produto._components.form_create_edit', [
                'produtos' => $produtos,
                'fornecedores' => $fornecedores,
                'entrada_produto'=>$entrada_produto
            ])
            @endcomponent
        </div>
    </div>
    
@endsection
