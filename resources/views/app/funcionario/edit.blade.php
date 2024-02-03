@extends('app.layouts.app')

@section('content')

    <div class="card">
        <div class="card-header-template">
            <div>EDITAR FUNCIONÁRIO</div>
            <div>
                <a href="{{route('funcionario.index')}}" class="btn btn-sm btn-primary">
                    LISTAGEM
                </a>
    
                <a href="{{route('funcionario.create')}}" class="btn btn-sm btn-primary">
                    NOVO
                </a>
            </div>
        </div>
        
        <div class="card-body">
            @component('app.funcionario._components.form_create_edit', 
            [
                'funcionario'=>$funcionario,
                'ufs'=>$ufs
            ])
                    
                @endcomponent  
        </div>
    </div>


@endsection





