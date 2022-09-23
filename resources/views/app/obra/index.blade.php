@extends('app.layouts.app')

@section('content')
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
                        <th scope="col" class="th-title">Id</th>
                        <th scope="col" class="th-title">Nome</th>
                        <th scope="col" class="th-title">Empresa</th>
                        <th scope="col" class="th-title">Endereço</th>
                        <th scope="col" class="th-title">Operações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($obras as $obra)
                        <tr>
                            <th scope="row">{{ $obra->id }}</td>
                            <td>{{ $obra->nome}}</td>
                            <td>{{ $obra->empresa->nome_fantasia}}</td>
                            <td>{{ $obra->endereco}}</td>
                            <td>
                                <div class="div-op">
                                    <a class="btn btn-sm-template btn-primary mx-1"
                                        href="{{ route('obra.show', ['obra' => $obra->id]) }}"><i
                                            class="icofont-eye-alt"></i></a>
                                    <a class="btn btn-sm-template btn-success mx-1 @can('user') disabled @endcan"
                                        href="{{ route('obra.edit', ['obra' => $obra->id]) }}"><i
                                            class="icofont-pen-alt-1"></i></a>
                                    <form id="form_{{ $obra->id }}" method="post"
                                        action="{{ route('obra.destroy', ['obra' => $obra->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-sm-template btn-danger mx-1 @can('user') disabled @endcan" href="#"
                                            onclick="document.getElementById('form_{{ $obra->id }}').submit()"><i
                                                class="icofont-close-squared-alt"></i></a>
                                    </form>
                                </div>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{$obras->appends($request)->links()}}
            </div>

        </div>

    </div>


@endsection