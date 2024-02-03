@extends('app.layouts.app')

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
                                    <div {{-- class="div-op" --}} class="btn-group btn-group-actions visible-on-hover">
                                        <a class="btn btn-sm-template btn-outline-primary"
                                            href="{{ route('funcionario.show', ['funcionario' => $funcionario->id]) }}"><i
                                                class="icofont-eye-alt"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-outline-success "
                                            @can('admin') href="{{ route('funcionario.edit', ['funcionario' => $funcionario->id]) }}"
                                            @elsecan('user') data-bs-toggle="modal" data-bs-target="#modal_msg" @endcan>
                                            <i class="icofont-ui-edit"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-outline-success"
                                            @can('admin') href="{{ route('funcionario.create', ['funcionario_selected' => $funcionario->id]) }}"
                                           @elsecan('user') data-bs-toggle="modal" data-bs-target="#modal_msg" @endcan>
                                            <i class="icofont-plus-square"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-outline-danger" href="#" data-bs-toggle="modal"
                                            @can('admin')data-bs-target="#deleteModal"
                                            @elsecan('user') data-bs-target="#modal_msg" @endcan
                                            data-id="{{ $funcionario->id }}">
                                            <i class="icofont-ui-delete"></i>
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
