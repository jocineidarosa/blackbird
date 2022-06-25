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
                        <th scope="col">Operações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($marcas as $marca)
                        <tr>
                            <th scope="row">{{ $marca->id }}</td>
                            <td>{{ $marca->nome }}</td>
                            <td>{{ $marca->descricao }}</td>
                            <td>
                                <div class="div-op">
                                    <a class="btn btn-sm-template btn-primary mx-1"
                                        href="{{ route('marca.show', ['marca' => $marca->id]) }}"><i
                                            class="icofont-eye-alt"></i></a>
                                    <a class="btn btn-sm-template btn-success mx-1 @can('user') disabled @endcan"
                                        href="{{ route('marca.edit', ['marca' => $marca->id]) }}"><i
                                            class="icofont-pen-alt-1"></i></a>
                                    <form id="form_{{ $marca->id }}" method="post"
                                        action="{{ route('marca.destroy', ['marca' => $marca->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-sm-template btn-danger mx-1 @can('user') disabled @endcan" href="#"
                                            onclick="document.getElementById('form_{{ $marca->id }}').submit()"><i
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