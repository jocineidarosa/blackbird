



@extends('app.layouts.app')

@section('titulo', 'Produtos')

@section('content')
    <div class="card">
        <div class="card-header-template">
            <div>EDITAR UNIDADE DE MEDIDA</div>
            <div>
                <a href="{{ route('unidade-medida.index') }}" class="btn btn-sm btn-primary">
                    LISTAGEM
                </a>
            </div>
        </div>
        <div class="card-body">
            @component('app.unidade_medida._components.form_create_edit', ['unidade_medida'=>$unidade_medida])
                    
                @endcomponent  
        </div>
    </div>

@endsection





