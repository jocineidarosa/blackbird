@extends('app.layouts.app')

@section('titulo', 'Marcas')

@section('content')

    <main class="content">
        <div class="card">
            <div class="card-header-template">
                <div>Listagem de Fornecedores</div>
                <div>
                    <a href="{{ route('fornecedor.create') }}" class="btn btn-primary btn-sm">
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
                        @foreach ($fornecedores as $fornecedor)
                            <tr>
                                <th scope="row">{{ $fornecedor->id }}</td>
                                <td>{{ $fornecedor->nome_fantasia }}</td>
                                <td>{{ $fornecedor->cnpj }}</td>
                                <td>{{ $fornecedor->endereco }}</td>
                                <td>{{ $fornecedor->cidade }}</td>
                                <td>{{ $fornecedor->estado }}</td>
                                <td>{{ $fornecedor->telefone }}</td>
                                <td>{{ $fornecedor->site }}</td>
                                <td>
                                    <div class="div-op">
                                        <a class="btn btn-sm-template btn-primary mx-1"
                                            href="{{ route('fornecedor.show', ['fornecedor' => $fornecedor->id]) }}"><i
                                                class="icofont-eye-alt"></i></a>
                                        <a class="btn btn-sm-template btn-success mx-1 @can('user') disabled @endcan"
                                            href="{{ route('fornecedor.edit', ['fornecedor' => $fornecedor->id]) }}"><i
                                                class="icofont-pen-alt-1"></i></a>
                                        <form id="form_{{ $fornecedor->id }}" method="post"
                                            action="{{ route('fornecedor.destroy', ['fornecedor' => $fornecedor->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <a class="btn btn-sm-template btn-danger mx-1 @can('user') disabled @endcan" href="#"
                                                onclick="document.getElementById('form_{{ $fornecedor->id }}').submit()"><i
                                                    class="icofont-close-squared-alt"></i></a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>


    </main>

@endsection
