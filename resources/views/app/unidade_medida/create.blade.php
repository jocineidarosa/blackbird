@extends('app.layouts.app')

@section('content')

<main class="content">
    <div class="card">
        <div class="card-header-template">
            <div>CADASTRO DE UNIDADE DE MEDIDA</div>
            <div>
                <a href="{{ route('unidade-medida.index') }}" class="btn btn-sm btn-primary">
                    LISTAGEM
                </a>
            </div>
        </div>
        <div class="card-body">
            @component('app.unidade_medida._components.form_create_edit')       
            @endcomponent
        </div>
    </div>

</main>

@endsection




