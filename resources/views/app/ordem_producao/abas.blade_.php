

@extends('app.layouts.app')

@section('titulo', 'Marcas')

@section('content')
<main class="content">
    <div class="card">
        <div class="card-header-template">
            <div>
                LISTAGEM DE MARCAS
            </div>
            <div>
                <a class="btn btn-primary btn-sm" href="{{ route('marca.create') }}">NOVO</a>
            </div>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs " role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="#tab_formulario" class="nav-link active" id="link_formulario" data-toggle="tab" 
                    role="tab" aria-controls="tab_formulario">Dados Principais</a>
                </li>
        
                <li class="nav-tabs" role="presentation">
                    <a href="#tab_recursos" class="nav-link" id="link_recursos" data-toggle="tab" 
                    role="tab" aria-controls="tab_recursos">Recursos Utilizados</a>
                </li>
        
            </ul>
            <div class="tab-content" id="tab-dados-principais">
                <div class="tab-pane fade show active" id="tab_formulario" role="tabpanel" aria-labelledby="link_formulario">
                    Dados Principais
                </div>
            </div>
        
            <div class="tab-content" id="tab_dados_recursos">
                <div class="tab-pane fade" id="tab_recursos" role="tabpanel" aria-labelledby="link_recursos">
                    Dados
                </div>
            </div>

        </div>

    </div>


</main>

@endsection
{{-- -------------- --}}
    
