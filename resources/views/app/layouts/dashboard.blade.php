@extends('app.layouts.app')
@section('titulo', 'Dashboard')
<main class="content">
    <div class="card">
        <div class="card-header-template">
            <div>
                <i class="icofont-cubes mr-2"></i>
                Estoque de Produtos
            </div>
            <div>
            </div>
        </div>
        <div class="card-body">

            @foreach ($estoque_produtos as $estoque)
            <div class="painel-estoque-dashboard">
                <div class="field-dash">
                    {{$estoque->nome}}
                </div>
                <div class="field-dash">
                    {{$estoque->estoque_atual}}
                </div>
            </div>
            @endforeach
        </div>
    </div>


</main>
