<div class="card">
        <div class="card-header-template">
            <div><i class="icofont-list mr-2"></i>LISTAGEM DE abastecimento</div>
            <form id="formSearchingProducts" action="{{route('produto.index')}}" method="get">
                <!--input box filtro buscar produto--------->
                <input type="text" id="query" name="produto" placeholder="Buscar produto..." aria-label="Search through site content">
                <button type="submit" class="button-search">
                    <i class="icofont-search"></i>
                </button>
            </form>
            <div>
                <a href="{{ route('produto.create') }}" class="btn btn-sm btn-primary">
                    <i class="icofont-plus-circle mr-1"></i>NOVO
                </a>
                <a href="{{ route('produto.index') }}" class="btn btn-sm btn-primary">
                    <i class="icofont-page"></i>TODOS
                </a>
                <a href="{{ route('produto.export_pdf') }}" class="btn btn-sm btn-primary">
                    <i class="icofont-plus-circle mr-1"></i>PDF
                </a>
            </div>

        </div>
        <div class="card-body">
            <table class="table-template table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="th-title">Id</th>
                        <th scope="col" class="th-title">equipamento</th>
                        <th scope="col" class="th-title">data</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($abastecimentos as $abastecimento)
                        <tr>
                            <th scope="row">{{ $abastecimento->id }}</td>
                            <td>{{ $abastecimento->equipamento_id }}</td>
                            <td>{{ $abastecimento->data}}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>


    </div>
