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
                            <th scope="col" class="th-title">Visualizar</th>
                            <th scope="col" class="th-title">Excluir</th>
                            <th scope="col" class="th-title">Editar</th>
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
                                    <a class="btn btn-primary btn-sm"href="{{ route('fornecedor.show', ['fornecedor' => $fornecedor->id]) }}">Visualizar</a>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm"href="{{ route('fornecedor.edit', ['fornecedor' => $fornecedor->id]) }}">Editar</a>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm"href="#" onclick="document.getElementById('form_{{ $fornecedor->id }}').submit()">Excluir</a>
                                    <form id="form_{{ $fornecedor->id }}" method="post"
                                        action="{{ route('fornecedor.destroy', ['fornecedor' => $fornecedor->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>


    </main>

@endsection
