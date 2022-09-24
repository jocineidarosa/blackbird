@extends('app.layouts.app')

@section('titulo', 'Fornecedor')

@section('content')

        <div class="card">
            <div class="card-header-template">
                <div>Editar Empresa</div>
                <div>
                    <a href="{{ route('empresa.create') }}" class="btn btn-primary btn-sm">
                        NOVO
                    </a>
                    <a href="{{ route('empresa.index') }}" class="btn btn-primary btn-sm">
                        LISTAGEM
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                @component('app.empresa._components.form_create_edit', ['empresa' => $empresa, 'ufs'=>$ufs])
                @endcomponent

            </div>

        </div>

@endsection
