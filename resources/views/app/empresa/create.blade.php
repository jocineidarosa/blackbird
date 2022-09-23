@extends('app.layouts.app')

@section('content')

    <div class="card">
        <div class="card-header-template">
            <div>CADASTRO DE EMPRESAS</div>
            <div>
                <a href="{{route('empresa.index')}}" class="btn btn-primary btn-sm-template">
                    LISTAGEM
                </a>
            </div>
        </div>
        
        <div class="card-body">
            @component('app.empresa._components.form_create_edit', [
                'empresas'=>$empresas,
                'cidades'=>$cidades
                ])     
            @endcomponent
        </div>

    </div>


@endsection

