@extends('app.layouts.app')

@section('content')
        <div class="card">
            <div class="card-header-template">
                <div>CADASTRO DE PESSOAS</div>
                <div>
                    <a href="{{ route('pessoa.index') }}" class="btn btn-sm btn-primary">
                        LISTAGEM
                    </a>
                </div>
            </div>

            <div class="card-body">
                @component('app.pessoa._components.form_create_edit', ['ufs'=>$ufs])
                @endcomponent
            </div>
        </div>

@endsection
