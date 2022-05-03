@extends('app.layouts.app')

@section('content')
    <main class="content">
        <div class="card">
            <div class="card-header-template">
                <div>CADASTRO DE OPERAÇÃO DE EQUIPAMENTOS</div>
                <div>
                    <a href="{{ route('produto.index') }}" class="btn btn-sm btn-primary">
                        LISTAGEM
                    </a>
                </div>
            </div>

            <div class="card-body">
                @component('app.operacao_equipamento._components.form_create_edit', 
                    [
                        'equipamentos'=>$equipamentos,
                        'produtos'=>$produtos
                    ])
                @endcomponent
            </div>
        </div>

    </main>
@endsection
