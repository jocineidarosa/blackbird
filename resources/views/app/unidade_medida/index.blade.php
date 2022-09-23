@extends('app.layouts.app')
@section('titulo', 'Produtos')

@section('content')
        <div class="card">
            <div class="card-header-template mb-1">
                <div>
                    LISTAGEM DE UNIDADE DE MEDIDA
                </div>
                <div>
                    <a class="btn btn-info btn-sm mr-2" href="{{route('unidade-medida.create') }}">NOVO</a>
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
                        @foreach ($unidades_medidas as $unidade_medida)
                            <tr>
                                <th scope="row">{{ $unidade_medida->id }}</td>
                                <td>{{ $unidade_medida->nome }}</td>
                                <td>{{ $unidade_medida->descricao }}</td>
                                <td>
                                    <div class="div-op">
                                        <a class="btn btn-sm-template btn-primary mx-1"
                                            href="{{ route('unidade-medida.show', ['unidade_medida' => $unidade_medida->id]) }}"><i
                                                class="icofont-eye-alt"></i></a>
                                        <a class="btn btn-sm-template btn-success mx-1 @can('user') disabled @endcan"
                                            href="{{ route('unidade-medida.edit', ['unidade_medida' => $unidade_medida->id]) }}"><i
                                                class="icofont-pen-alt-1"></i></a>
                                        <form id="form_{{ $unidade_medida->id }}" method="post"
                                            action="{{ route('unidade-medida.destroy', ['unidade_medida' => $unidade_medida->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <a class="btn btn-sm-template btn-danger mx-1 @can('user') disabled @endcan" href="#"
                                                onclick="document.getElementById('form_{{ $unidade_medida->id }}').submit()"><i
                                                    class="icofont-close-squared-alt"></i></a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{$unidades_medidas->appends($request)->links()}}
                </div>


            </div>


        </div>

@endsection
