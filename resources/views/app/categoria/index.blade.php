@extends('app.layouts.app')

@section('content')
    <main class="content">
        <div class="card">
            <div class="card-header-template">
                <div>LISTAGEM DE CATEGORIAS</div>
                <div>
                    <a href="{{route('category.create')}}" class="btn btn-sm-template btn-primary">
                        NOVO
                    </a>
                </div>

            </div>
            
            <div class="card-body">
                <table class="table-template table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="th-title">Id</th>
                            <th scope="col" class="th-title">Nome</th>
                            <th scope="col" class="th-title">Visualizar</th>
                            <th scope="col" class="th-title">Editar</th>
                            <th scope="col" class="th-title">Excluir</th>
                            
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <th scope="row" class="th-title">{{ $categoria->id }}</td>
                                <td>{{ $categoria->nome }}</td>
                                <td><a class="btn btn-sm-template btn-primary" href="#">Visualizar</a></td>
                                
                                <td><a class="btn btn-sm-template btn-primary" href="#">Editar</a></td>

                                <td>
                                    <form id="form_{{ $categoria->id }}" method="post"
                                        action="{{ route('category.destroy', ['category' => $categoria->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-sm-template btn-danger" href="#"
                                            onclick="document.getElementById('form_{{ $categoria->id }}').submit()">Excluir</a>
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
