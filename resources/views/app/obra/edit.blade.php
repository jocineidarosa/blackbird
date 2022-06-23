@extends('app.layouts.app')


@section('content')

    <main class="content">
        <div class="card">
            <div class="card-header-template">
                <div>Editar Obra</div>
                <div>
                    <a href="{{ route('obra.create') }}" class="btn btn-sm btn-primary">
                        NOVO
                    </a>
                    <a href="{{ route('obra.index') }}" class="btn btn-sm btn-primary">
                        LISTAGEM
                    </a>
                </div>
            </div>

            <div class="card-body">
                @component('app.obra._components.form_create_edit', 
                [
                    'empresas' => $empresas,
                    'obra'=>$obra
                ])
                @endcomponent

            </div>

        </div>


    </main>

@endsection
