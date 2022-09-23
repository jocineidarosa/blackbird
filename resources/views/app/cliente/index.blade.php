@extends('app.layouts.app')

@section('content')
        <div class="card">
            <div class="card-header-template">
                <div> LISTAGEM DE CLIENTES</div>
                <div>
                    <a href="{{ route('cliente.create') }}" class="btn btn-sm btn-primary">
                        NOVO
                    </a>
                </div>

            </div>
            <div class="card-body">
                <table class="table-template table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="th-title">Id</th>
                            <th scope="col" class="th-title">Cliente</th>
                            <th class="th-title">Operações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <th scope="row">{{ $cliente->id }}</td>
                                <td>{{ $cliente->empresa->razao_social ?? $cliente->pessoa->nome}}</td>
                                <td>
                                    <div class="div-op">
                                        <a class="btn btn-sm-template btn-primary mx-1"
                                            href="{{ route('cliente.show', ['cliente' => $cliente->id]) }}"><i
                                                class="icofont-eye-alt"></i></a>
                                        <a class="btn btn-sm-template btn-success mx-1 @can('user') disabled @endcan"
                                            href="{{ route('cliente.edit', ['cliente' => $cliente->id]) }}"><i
                                                class="icofont-pen-alt-1"></i></a>
                                        <form id="form_{{ $cliente->id }}" method="post"
                                            action="{{ route('cliente.destroy', ['cliente' => $cliente->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <a class="btn btn-sm-template btn-danger mx-1 @can('user') disabled @endcan" href="#"
                                                onclick="document.getElementById('form_{{ $cliente->id }}').submit()"><i
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

@endsection
