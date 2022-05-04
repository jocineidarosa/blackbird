@extends('app.layouts.app')

@section('content')
    <main class="content">
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
                            <th class="th-title"></th>
                            <th class="th-title"></th>  
                            <th class="th-title"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <th scope="row">{{ $cliente->id }}</td>
                                <td>{{ $cliente->empresa->razao_social ?? $cliente->pessoa->nome}}</td>
                                <td><a class="btn btn-sm-template btn-primary" href="#">Visualizar</a>
                                </td>
                                <td><a class="btn btn-sm-template btn-primary" href="#">Editar</a>
                                </td>
                                <td>
                                    <form id="form_{{ $cliente->id }}" method="post" 
                                        action="{{route('entrada-produto.destroy', ['entrada_produto'=>$cliente->id])}}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-sm-template btn-danger" href="#"
                                            onclick="document.getElementById('form_{{$cliente->id }}').submit()">Excluir</a>
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
