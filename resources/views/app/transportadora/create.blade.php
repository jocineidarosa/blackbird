@extends('app.layouts.app')

@section('titulo', 'Marcas')

@section('content')
        <div class="card">
            <div class="card-header-template">
                <div>
                    CADASTRAR TRANSPORTADORA
                </div>
                <div>
                    <a class="btn btn-sm btn-primary" href="{{ route('transportadora.index') }}">LISTAGEM</a>
                </div>
            </div>
            <div class="card-body">
                @component('app.transportadora._components.form_create_edit')
                @endcomponent
            </div>
        </div>
@endsection
