@extends('app.layouts.app')

@section('content')
    <main class="content">
        <div class="card">
            <div class="card-header-template">
                <div>LISTAGEM DE EQUIPAMENTOS</div>
                <div>
                    <a class="btn btn-sm btn-primary" href="{{ route('equipamento.create') }}" class="btn">
                        NOVO
                    </a>
                </div>
            </div>
            
            <div class="card-body">

                <table class="table-template table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Equipamento Pai</th>
                            <th scope="col">Visualizar</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Excluir</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($equipamentos as $equipamento)
                            <tr>
                                <th scope="row">{{ $equipamento->id }}</td>
                                <td>{{ $equipamento->nome }}</td>
                                <td>{{ $equipamento->descricao }}</td>
                                <td>{{ $equipamento->marca->nome }}</td>
                                <td>{{ $equipamento->equip_pai->nome ?? '' }}</td>
                                <td><a class="btn btn-sm-template btn-primary"
                                        href="{{ route('equipamento.show', ['equipamento' => $equipamento->id]) }}">Visualizar</a>
                                </td>
                                <td><a class="btn btn-sm-template btn-primary"
                                        href="{{ route('equipamento.edit', ['equipamento' => $equipamento->id]) }}">Editar</a>
                                </td>
                                <td>
                                    <form id="form_{{ $equipamento->id }}" method="post"
                                        action="{{ route('equipamento.destroy', ['equipamento' => $equipamento->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-sm-template btn-danger" href="#"
                                            onclick="document.getElementById('form_{{ $equipamento->id }}').submit()">Excluir</a>
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
