@extends('app.layouts.app')

@section('content')

    <div class="card">
        <div class="card-header-template pb-2">
            <div>CADASTRO DE CATEGORIAS</div>
            <div> <a class="btn btn-sm-template btn-primary" href="{{route('category.index')}}" class="btn">
                    LISTAGEM
                </a>
            </div>
        </div>
       
        <div class="card-body">
            @component('app.categoria._components.form_create_edit')       
            @endcomponent
        </div>
    </div>


@endsection




