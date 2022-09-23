@extends('app.layouts.app')

@section('content')

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
                            <th scope="col" class="th-title">ID</th>
                            <th scope="col" class="th-title">Nome</th>
                            <th scope="col" class="th-title">Descrição</th>
                            <th scope="col" class="th-title">Marca</th>
                            <th scope="col" class="th-title">Equipamento Pai</th>
                            <th scope="col" class="th-title">Operações</th>
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
                                <td>
                                    <div class="div-op">
                                        <a class="btn btn-sm-template btn-primary mx-1"
                                            href="{{ route('equipamento.show', ['equipamento' => $equipamento->id]) }}"><i
                                                class="icofont-eye-alt"></i></a>
                                        <a class="btn btn-sm-template btn-success mx-1 @can('user') disabled @endcan"
                                            href="{{ route('equipamento.edit', ['equipamento' => $equipamento->id]) }}"><i
                                                class="icofont-pen-alt-1"></i></a>
                                        <form id="form_{{ $equipamento->id }}" method="post"
                                            action="{{ route('equipamento.destroy', ['equipamento' => $equipamento->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <a class="btn btn-sm-template btn-danger mx-1 @can('user') disabled @endcan" href="#"
                                                onclick="document.getElementById('form_{{ $equipamento->id }}').submit()"><i
                                                    class="icofont-close-squared-alt"></i></a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{$equipamentos->appends($request)->links()}}
                </div>
            </div>

        </div>

@endsection
