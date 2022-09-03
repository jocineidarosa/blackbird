@extends('app.layouts.app')
@section('titulo', 'Dashboard')
<main class="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="icofont-leaflet mr-2"></i>Estoque de Produtos</a>
        </div>

        <!-- Content Row -->
        <div class="row">
            @foreach ($estoque_produtos as $estoque )
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    {{$estoque->nome}}</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$estoque->estoque_atual}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="icofont-navigation-menu"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
            @endforeach

            

        </div>
    </div>






</main>
