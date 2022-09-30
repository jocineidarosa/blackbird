@extends('app.layouts.app')

@section('content')
        <div class="card">
            <div class="card-header-template">
                <div>CADASTRO DE FUNCIONARIO</div>
                <div>
                    <a href="{{ route('funcionario.index') }}" class="btn btn-sm btn-primary">
                        LISTAGEM
                    </a>
                </div>
            </div>

            <div class="card-body">
                @component('app.funcionario._components.form_create_edit', ['pessoas'=>$pessoas])
                @endcomponent
            </div>
        </div>

@endsection
