@extends('app.layouts.app')

@section('content')
    <!-------------------------------------------------------------------------->
    <div class="card">
        <div class="card-header-template">
            <div><i class="icofont-list mr-2"></i>LISTAGEM DE PESAGENS</div>
            <form id="formSearchingProducts" action="{{route('pesagem.index')}}" method="get">
                <!--input box filtro buscar produto--------->
                <input type="text" id="query" name="filtro_motorista" placeholder="Buscar Motorista..." aria-label="Search through site content">
                <button type="submit" class="button-search">
                    <i class="icofont-search"></i>
                </button>
            </form>
        </div>

        <div class="card-header-template">
            <div>
                <a href="{{ route('pesagem.index') }}" class="btn btn-sm btn-primary mb-1">
                    <i class="icofont-page pr-2"></i>TODOS
                </a>
                <a href="{{ route('pesagem.consulta_avancada') }}" class="btn btn-sm btn-primary mb-1">
                    <i class="icofont-filter"></i>CONSULTA AVANÇADA
                </a>
                <a href="{{route('pesagem.pdf_export')}}{{$filtros ? $filtros : ''}}" class="btn btn-sm btn-danger mb-1" target="_blank">
                    <i class="icofont-file-pdf pr-2"></i>PDF
                </a>
                <a href="#{{-- colocar rota --}}" class="btn btn-sm btn-success mb-1">
                    <i class="icofont-file-excel"></i>Excel
                </a>
                
            </div>

        </div>

       
        <div class="card-body">
            <table class="table-template table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="th-title">Ticket</th>
                        <th scope="col" class="th-title">Data</th>
                        <th scope="col" class="th-title">Placa</th>
                        <th scope="col" class="th-title">Seq.</th>
                        <th scope="col" class="th-title">Parceiro</th>
                        <th scope="col" class="th-title">Produto</th>
                        <th scope="col" class="th-title">Motorista</th>
                        <th scope="col" class="th-title">Peso Tara</th>
                        <th scope="col" class="th-title">Peso Bruto</th>
                        <th scope="col" class="th-title">Peso Líquido</th>
                        <th scope="col" class="th-title">Tipo</th>
                        <th scope="col" class="th-title">Situação</th>
                        <th scope="col" class="th-title"><i class="icofont-print"></i>Imp.</th>
                        

                    </tr>
                </thead>

                <tbody>
                    @include('app.pesagem._components.pesagem_row', ['pesagens'=>$pesagens])
                </tbody>
            </table>
            @component('app.shared.modal_delete')
                {{ route('produto.destroy') }}
            @endcomponent
            <div class="d-flex justify-content-center">
                {{ $pesagens->appends($request)->links() }}
            </div>

        </div>


    </div>
    <script>
        function reloadWeighings() {
            $.ajax({
                url: "{{ route('pesagem.reload') }}",
                type: 'GET',
                success: function(data) {
                    $('tbody').html(data);
                }
            });
        }
    
        // Refresh every 5 seconds
        setInterval(reloadWeighings, 5000);
    </script>


@endsection
