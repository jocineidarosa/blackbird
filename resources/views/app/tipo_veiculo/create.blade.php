@extends('app.layouts.app')

@section('content')
    <main class="content">
        <div class="card">
            <div class="card-header-template">
                <div>CADASTRO DE TIPOS DE VEÍCLOS</div>
                <div>
                    <a href="{{ route('tipo-veiculo.index') }}" class="btn btn-sm btn-primary">
                        LISTAGEM
                    </a>
                </div>
            </div>

            <div class="card-body">
                @component('app.tipo_veiculo._components.form_create_edit')
                @endcomponent
            </div>
        </div>

    </main>
@endsection
