



@extends('app.layouts.app')

@section('titulo', 'Produtos')

@section('content')


    <div class="card">
        <div class="card-header-template">
            <div>EDITAR SAÍDA DE PRODUTOS</div>
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
            @component('app.saida_produto._components.form_create_edit', [
                'saida_produto'=>$saida_produto, 
                'produtos'=>$produtos,
                'tipos_saida'=>$tipos_saida
                ])
                    
                @endcomponent  
        </div>
    </div>


@endsection





