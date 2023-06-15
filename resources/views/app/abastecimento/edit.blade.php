



@extends('app.layouts.app')

@section('titulo', 'Abastecimentos')

@section('content')

    <div class="card">
        <div class="card-header-template">
            <div>EDITAR ABASTECIMENTO</div>
            <div>
                <a href="{{route('abastecimento.index')}}" class="btn btn-sm btn-primary">
                    LISTAGEM
                </a>
    
                <a href="{{route('abastecimento.create')}}" class="btn btn-sm btn-primary">
                    NOVO
                </a>
            </div>
        </div>
        
        <div class="card-body">
            @component('app.abastecimento._components.form_create_edit', 
            [
                'abastecimento'=>$abastecimento, 
                'equipamentos'=>$equipamentos,
                'produtos'=>$produtos,
                'total_horimetro'=>$total_horimetro
            ])
                    
                @endcomponent  
        </div>
    </div>


@endsection





