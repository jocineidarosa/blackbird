@extends('app.layouts.app')

@section('content')
        <div class="card">
            <div class="card-header-template">
                <div>CADASTRO DE ABASTECIMENTOS</div>
                <div>
                    <a href="{{ route('abastecimento.index') }}" class="btn btn-sm btn-primary">
                        LISTAGEM
                    </a>
                </div>
            </div>

            <div class="card-body">
                @component('app.abastecimento._components.form_create_edit', 
                    [
                        'equipamentos'=>$equipamentos,
                        'produtos'=>$produtos,
                        'contador_inicial'=>$contador_inicial,
                    ])
                @endcomponent
            </div>
        </div>

@endsection
