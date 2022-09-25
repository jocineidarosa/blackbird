@extends('app.layouts.app')

@section('content')
        <div class="card">
            <div class="card-header-template">
                <div>Saída de Produtos</div>
                <div>
                    <a href="{{ route('saida-produto.index') }}" class="btn btn-sm btn-primary">
                        LISTAGEM
                    </a>
                </div>
            </div>

            <div class="card-body">
                @component('app.saida_produto._components.form_create_edit', [
                    'produtos'=>$produtos,
                    'tipos_saida'=>$tipos_saida
                    ])
                @endcomponent
            </div>
        </div>

@endsection
