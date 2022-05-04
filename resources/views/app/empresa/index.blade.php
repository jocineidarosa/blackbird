@extends('app.layouts.app')


@section('content')

    <main class="content">
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
                            <th scope="col" class="th-title">Visualizar</th>
                            <th scope="col" class="th-title">Excluir</th>
                            <th scope="col" class="th-title">Editar</th>
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
                                    <a class="btn btn-primary btn-sm"href="{{ route('fornecedor.show', ['fornecedor' => $empresa->id]) }}">Visualizar</a>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm"href="{{ route('fornecedor.edit', ['fornecedor' => $empresa->id]) }}">Editar</a>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm"href="#" onclick="document.getElementById('form_{{ $empresa->id }}').submit()">Excluir</a>
                                    <form id="form_{{ $empresa->id }}" method="post"
                                        action="{{ route('fornecedor.destroy', ['fornecedor' => $empresa->id]) }}">
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
