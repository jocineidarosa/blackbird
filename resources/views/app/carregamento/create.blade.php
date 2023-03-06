@extends('app.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header-template">
            <div>CADASTRO DE CARREGAMENTO DE CARGAS</div>
            <div>
                <a href="{{ route('produto.index') }}" class="btn btn-sm btn-primary">
                    LISTAGEM
                </a>
            </div>
        </div>

        <div class="card-body">
            @component('app.carregamento._components.form_create_edit', [
                'placas' => $placas,
            ])
            @endcomponent
        </div>
    </div>
@endsection
