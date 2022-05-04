@extends('app.layouts.app')

@section('content')
    <main class="content">
        <div class="card">
            <div class="card-header-template">
                <div>Cadastro de Clientes</div>
                <div>
                    <a href="{{ route('cliente.index') }}" class="btn btn-sm btn-primary">
                        LISTAGEM
                    </a>
                </div>
            </div>

            <div class="card-body">
                @component('app.cliente._components.form_create_edit', [
                    'empresas'=>$empresas, 'pessoas'=>$pessoas
                    ])
                @endcomponent
            </div>
        </div>

    </main>
@endsection
