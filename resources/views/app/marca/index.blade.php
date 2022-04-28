@extends('app.layouts.app')

@section('titulo', 'Marcas')

@section('content')
<main class="content">
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
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Visualizar</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Excluir</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($marcas as $marca)
                        <tr>
                            <th scope="row">{{ $marca->id }}</td>
                            <td>{{ $marca->nome }}</td>
                            <td>{{ $marca->descricao }}</td>
                            <td><a class="btn btn-sm-template btn-primary" href="{{ route('marca.show', ['marca' => $marca->id]) }}">Visualizar</a></td>
                            <td><a class="btn btn-sm-template btn-primary" href="{{ route('marca.edit', ['marca' => $marca->id]) }}">Editar</a></td>
                            <td>
                                <form id="form_{{ $marca->id }}" method="post"
                                    action="{{ route('marca.destroy', ['marca' => $marca->id]) }}">
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-sm-template btn-danger" href="#"
                                        onclick="document.getElementById('form_{{ $marca->id }}').submit()">Excluir</a>
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