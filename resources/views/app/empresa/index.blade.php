@extends('app.layouts.app')


@section('content')
    <div class="card">
        <div class="card-header-template">
            <div>LISTAGEM DE EMPRESAS</div>
            <div>
                <a href="{{ route('empresa.create') }}" class="btn btn-primary btn-sm">
                    NOVO
                </a>
            </div>
        </div>

        <div class="card-body">
            <table class="table-template table-hover table-striped table-bordered">
                <thead class="bg-active">
                    <tr>
                        <th scope="col" class="th-title">Id</th>
                        <th scope="col" class="th-title">Nome</th>
                        <th scope="col" class="th-title">CNPJ</th>
                        <th scope="col" class="th-title">Endereço</th>
                        <th scope="col" class="th-title">Cidade</th>
                        <th scope="col" class="th-title">Estado</th>
                        <th scope="col" class="th-title">Telefone</th>
                        <th scope="col" class="th-title">site</th>
                        <th scope="col" class="th-title">Operações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($empresas as $empresa)
                        <tr>
                            <th scope="row">{{ $empresa->id }}</td>
                            <td>{{ $empresa->nome_fantasia }}</td>
                            <td>{{ $empresa->cnpj }}</td>
                            <td>{{ $empresa->endereco }}</td>
                            <td>{{ $empresa->cidade }}</td>
                            <td>{{ $empresa->estado }}</td>
                            <td>{{ $empresa->telefone }}</td>
                            <td>{{ $empresa->site }}</td>
                            <td>
                                <div class="div-op">
                                    <a class="btn btn-sm-template btn-primary mx-1"
                                        href="{{ route('empresa.show', ['empresa' => $empresa->id]) }}"><i
                                            class="icofont-eye-alt"></i>
                                    </a>
                                    <a class="btn btn-sm-template btn-success mx-1 @can('user') disabled @endcan"
                                        href="{{ route('empresa.edit', ['empresa' => $empresa->id]) }}"><i
                                            class="icofont-pen-alt-1"></i>
                                    </a>
                                    <a class="btn btn-sm-template btn-danger mx-1 @can('user') disabled @endcan"
                                        href="#" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-id="{{ $empresa->id }}">
                                        <i class="icofont-close-squared-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @php
                            $data_id= $empresa
                        @endphp
                    @endforeach
                </tbody>
            </table>

            @component('app.shared.modal_delete')
                {{ route('empresa.destroy')}}
            @endcomponent
            <div class="d-flex justify-content-center">
                {{ $empresas->appends($request)->links()}}
            </div>
        </div>

    </div>
@endsection
