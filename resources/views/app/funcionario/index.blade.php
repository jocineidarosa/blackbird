@extends('app.layouts.app')
@section('titulo', 'Produtos')

@section('content')
        <div class="card">
            <div class="card-header-template">
                <div>LISTAGEM DE FUNCIONÁRIOS</div>
                <div>
                    <a href="{{ route('funcionario.create') }}" class="btn btn-sm btn-primary">
                        NOVO
                    </a>
                </div>

            </div>
            <div class="card-body">
                <table class="table-template table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="th-title">Id</th>
                            <th scope="col" class="th-title">Nome</th>
                            <th scope="col" class="th-title">CPF</th>
                            <th scope="col" class="th-title">Telefone</th>
                            <th scope="col" class="th-title">Salario</th>
                            <th scope="col" class="th-title">Operações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($funcionarios as $funcionario)
                            <tr>
                                <th scope="row">{{ $funcionario->id }}</td>
                                <td>{{ $funcionario->nome_completo}}</td>
                                <td>{{ $funcionario->cpf}}</td>
                                <td>{{ $funcionario->telefone }}</td>
                                <td>{{ $funcionario->salario }}</td>
                                <td>
                                    <div class="div-op">
                                        <a class="btn btn-sm-template btn-primary mx-1"
                                            href="{{ route('carregamento.show', ['carregamento' => $funcionario->id]) }}"><i
                                                class="icofont-eye-alt"></i>
                                        </a>
                                        <a
                                            class="btn btn-sm-template btn-success mx-1 @can('user') disabled @endcan 
                                            "href="{{ route('carregamento.edit', ['carregamento' => $funcionario->id]) }}">
                                            <i class="icofont-pen-alt-1"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-danger mx-1" href="#" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-id="{{ $funcionario->id }}"
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
                    {{ route('funcionario.destroy') }}
                @endcomponent
                <div class="d-flex justify-content-center">
                   {{--  {{ $veiculos->appends($request)->links() }} --}}
                </div>

            </div>


        </div>

@endsection
