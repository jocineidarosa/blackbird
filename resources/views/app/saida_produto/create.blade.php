@extends('app.layouts.app')

@section('content')
    <main class="content">
        <div class="card">
            <div class="card-header-template">
                <div>Entrada de Produtos</div>
                <div>
                    <a href="{{ route('saida-produto.index') }}" class="btn btn-sm btn-primary">
                        LISTAGEM
                    </a>
                </div>
            </div>

            <div class="card-body">
                @component('app.saida_produto._components.form_create_edit', [
                    'produtos'=>$produtos
                    ])
                @endcomponent
            </div>
        </div>

    </main>
@endsection
