@extends('app.layouts.app')
@section('titulo', 'Produtos')

@section('content')
        <div class="card">
            <div class="card-header-template">
                <div>LISTAGEM DE PESSOAS</div>
                <div>
                    <a href="{{ route('pessoa.create') }}" class="btn btn-sm btn-primary">
                        NOVO
                    </a>
                </div>

            </div>
            <div class="card-body">
                <table class="table-template table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="th-title">Id</th>
                            <th scope="col" class="th-title">nome</th>
                            <th scope="col" class="th-title">CPF</th>
                            <th scope="col" class="th-title">Telefone</th>
                            <th scope="col" class="th-title">Data Nasc.</th>
                            <th scope="col" class="th-title">Operações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pessoas as $pessoa)
                            <tr>
                                <th scope="row">{{ $pessoa->id }}</td>
                                <td>{{ $pessoa->nome . ' '. $pessoa->sobrenome }}</td>
                                <td>{{ $pessoa->cpf}}</td>
                                <td>{{ $pessoa->telefone}}</td>
                                <td>{{ $pessoa->data_nascimento}}</td>
                                <td>
                                    <div class="div-op">
                                        <a class="btn btn-sm-template btn-primary mx-1"
                                            href="{{ route('pessoa.show', ['pessoa' => $pessoa->id]) }}"><i
                                                class="icofont-eye-alt"></i>
                                        </a>
                                        <a
                                            class="btn btn-sm-template btn-success mx-1 @can('user') disabled @endcan 
                                            "href="{{ route('pessoa.edit', ['pessoa' => $pessoa->id]) }}">
                                            <i class="icofont-pen-alt-1"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-danger mx-1" href="#" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-id="{{ $pessoa->id }}"
                                            @can('user') disabled @endcan>
                                            <i class="icofont-close-squared-alt"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @component('app.shared.modal_delete')
                    {{ route('pessoa.destroy') }}
                @endcomponent
                <div class="d-flex justify-content-center">
                   {{--  {{ $pessoas->appends($request)->links() }} --}}
                </div>

            </div>


        </div>

@endsection
