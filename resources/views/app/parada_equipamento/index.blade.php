@extends('app.layouts.app')

@section('content')
        <div class="card">
            <div class="card-header-template mb-1">
                <div>
                    LISTAGEM DE PARADAS DE EQUIPAMENTOS
                </div>
                <div>
                    <a class="btn btn-info btn-sm mr-2" href="{{ route('parada-equipamento.create') }}">NOVO</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table-template table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Data</th>
                            <th scope="col">Início</th>
                            <th scope="col">Fim</th>
                            <th scope="col">Descricao</th>
                            <th scope="col">Operações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($paradas as $parada)
                            <tr>
                                <th scope="row">{{ $parada->id }}</td>
                                <td>{{ $parada->ordem_producao->data }}</td>
                                <td>{{ $parada->hora_inicio }}</td>
                                <td>{{ $parada->hora_fim }}</td>
                                <td>{{ $parada->descricao }}</td>
                                <td>
                                    <div class="div-op">
                                        <a class="btn btn-sm-template btn-primary mx-1"{{-- VISUALIZAR --}}
                                            href="{{route('parada-equipamento.show', ['parada_equipamento'=>$parada->id])}}"><i class="icofont-eye-alt"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-success mx-1 @can('user') disabled @endcan"{{-- EDITAR --}}
                                            href="{{route('parada-equipamento.edit', ['parada_equipamento'=>$parada->id])}}"><i
                                            class="icofont-pen-alt-1"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-danger mx-1" href="#" data-bs-toggle="modal"{{-- EXCLUIR --}}
                                            data-bs-target="#deleteModal" data-id="{{$parada->id }}"
                                            @can('user') disabled @endcan>
                                            <i class="icofont-close-squared-alt"></i>
                                        </a>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @component('app.shared.modal_delete'){{-- incorpora o componente modal delete --}}
                {{route('parada-equipamento.destroy', ['parada_equipamento'=>'1'])}}
                @endcomponent

            </div>

        </div>

@endsection
