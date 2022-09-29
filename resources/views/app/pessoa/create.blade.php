@extends('app.layouts.app')

@section('content')
        <div class="card">
            <div class="card-header-template">
                <div>CADASTRO DE VEÍCULOS</div>
                <div>
                    <a href="{{ route('veiculo.index') }}" class="btn btn-sm btn-primary">
                        LISTAGEM
                    </a>
                </div>
            </div>

            <div class="card-body">
                @component('app.veiculo._components.form_create_edit', ['tipos_veiculos'=>$tipos_veiculos, 'funcionarios'=>$funcionarios])
                @endcomponent
            </div>
        </div>

@endsection
