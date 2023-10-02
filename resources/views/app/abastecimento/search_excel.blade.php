@extends('app.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header-template">
            <div>CADASTRO DE ABASTECIMENTOS</div>
            <div>
                <a href="{{ route('abastecimento.index') }}" class="btn btn-sm btn-primary">
                    LISTAGEM
                </a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('abastecimento.import_excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" id="file" name="file">
                <button name="enviar" type="submit">Enviar
                </button>


            </form>


        </div>
    </div>

    <script></script>
@endsection
