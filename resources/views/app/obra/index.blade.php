@extends('app.layouts.app')

@section('content')
<main class="content">
    <div class="card">
        <div class="card-header-template">
            <div>
                LISTAGEM DE OBRAS
            </div>
            <div>
                <a class="btn btn-primary btn-sm" href="{{ route('obra.create') }}">NOVO</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table-template table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Empresa</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">Visualizar</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Excluir</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($obras as $obra)
                        <tr>
                            <th scope="row">{{ $obra->id }}</td>
                            <td>{{ $obra->nome}}</td>
                            <td>{{ $obra->empresa->nome_fantasia}}</td>
                            <td>{{ $obra->endereco}}</td>
                            <td><a class="btn btn-sm-template btn-primary" href="{{ route('marca.show', ['marca' => $obra->id]) }}">Visualizar</a></td>
                            <td><a class="btn btn-sm-template btn-primary" href="{{ route('marca.edit', ['marca' => $obra->id]) }}">Editar</a></td>
                            <td>
                                <form id="form_{{ $obra->id }}" method="post"
                                    action="{{ route('marca.destroy', ['marca' => $obra->id]) }}">
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-sm-template btn-danger" href="#"
                                        onclick="document.getElementById('form_{{ $obra->id }}').submit()">Excluir</a>
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