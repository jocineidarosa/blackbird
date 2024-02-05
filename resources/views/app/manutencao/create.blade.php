@extends('app.layouts.app')

@section('content')
        <div class="card">
            <div class="card-header-template">
                <div>CADASTRO DE MANUTENÇÕES</div>
                <div>
                    <a href="{{ route('manutencao.index') }}" class="btn btn-sm btn-primary">
                        LISTAGEM
                    </a>
                </div>
            </div>

            <div class="card-body">
                @component('app.manutencao._components.form_create_edit', 
                    [
                        'equipamentos'=>$equipamentos
                    ])
                @endcomponent
            </div>
        </div>

@endsection
