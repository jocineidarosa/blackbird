@extends('app.layouts.app')

@section('titulo', 'Marcas')

@section('content')
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
            <table class="table-template table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="th-title">Id</th>
                        <th scope="col" class="th-title">Nome</th>
                        <th scope="col" class="th-title">Descrição</th>
                        <th scope="col" class="th-title">Operações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($marcas as $marca)
                        <tr>
                            <th scope="row">{{ $marca->id }}</td>
                            <td>{{ $marca->nome }}</td>
                            <td>{{ $marca->descricao }}</td>
                            <td>
                                <div {{-- class="div-op" --}} class="btn-group btn-group-actions visible-on-hover">
                                    <a class="btn btn-sm-template btn-outline-primary"
                                        href="{{ route('marca.show', ['marca' => $marca->id]) }}"><i
                                            class="icofont-eye-alt"></i>
                                    </a>
                                    <a class="btn btn-sm-template btn-outline-success "
                                        @can('admin') href="{{ route('marca.edit', ['marca' => $marca->id]) }}"
                                        @elsecan('user') data-bs-toggle="modal" data-bs-target="#modal_msg" @endcan>
                                        <i class="icofont-ui-edit"></i>
                                    </a>
                                    <a class="btn btn-sm-template btn-outline-danger" href="#" data-bs-toggle="modal"
                                        @can('admin')data-bs-target="#deleteModal"
                                        @elsecan('user') data-bs-target="#modal_msg" @endcan
                                        data-id="{{ $marca->id }}">
                                        <i class="icofont-ui-delete"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            @component('app.shared.modal_delete')
                {{ route('marca.destroy') }}
            @endcomponent
            @component('app.shared.modal_msg_no_permission')
            @endcomponent
            <div class="d-flex justify-content-center">
                {{ $marcas->appends($request)->links() }}
            </div>

        </div>

    </div>


@endsection
