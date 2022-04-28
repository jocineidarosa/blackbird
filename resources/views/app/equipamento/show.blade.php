@extends('app.layouts.app')

@section('content')
<main class="content">
    <div class="card">
        <div class="card-header-template">
            <div>VISUALIZAR EQUIPAMENTO</div>
            <diV>
                <a class="btn btn-sm btn-primary" href="{{route('equipamento.index')}}" class="btn">
                    LISTAGEM
                </a>
    
                <a class="btn btn-sm btn-primary" href="{{route('equipamento.create')}}" class="btn">
                    NOVA MARCA
                </a>
            </div>
        </div>
        
        
        <div class="card-body">
            <table class="table-template table-hover">
                    <tr>
                        <td>ID</td>
                        <td>{{$equipamento->id}}</td>
                    </tr>
                    <tr>
                        <td>Nome</td>
                        <td>{{$equipamento->nome}}</td>
                    </tr>
                    <tr>
                        <td>DESCRIÇÂO</td>
                        <td>{{$equipamento->descricao}}</td>
                    </tr>
                    <tr>
                        <td>MARCA</td>
                        <td>{{$equipamento->marca->nome}}</td>
                    </tr>
                </table>
        </div>

        </div>
    </div>

</main>

@endsection






