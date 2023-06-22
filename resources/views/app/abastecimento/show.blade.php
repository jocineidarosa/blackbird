@extends('app.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header-template">
            <div>VISUALIZAÇÃO DE ABASTECIMENTO</div>
            <div>
                <a href="{{ route('abastecimento.index') }}" class="btn btn-sm btn-primary">
                    LISTAGEM
                </a>
            </div>
        </div>

        <div class="card-body">

            <div class="row mb-1">
                <label for="data" class="col-md-4 col-form-label text-md-end text-right">Equipamento</label>
                <div class="col-md-6">
                    <input id="data" name="data" type="text" class="form-control-template" disabled
                        value="{{ $abastecimento->equipamento->nome . '    -    ' . $abastecimento->equipamento->cod_operacao }}">
                </div>
            </div>

            <div class="row mb-1">
                <label for="data" class="col-md-4 col-form-label text-md-end text-right">Produto</label>
                <div class="col-md-6">
                    <input id="data" name="data" type="text" class="form-control-template" disabled
                        value="{{ $abastecimento->produto->nome }}">
                </div>
            </div>


            <div class="row mb-1">
                <label for="data" class="col-md-4 col-form-label text-md-end text-right">Data</label>
                <div class="col-md-6">
                    <input id="data" name="data" type="text" class="form-control-template" disabled
                        value="{{ date('d/m/Y', strtotime($abastecimento->data)) }}">
                </div>
            </div>

            <div class="row mb-1">
                <label for="medidor_inicial" class="col-md-4 col-form-label text-md-end text-right">Medidor Inicial</label>
                <div class="col-md-6">
                    <input id="medidor_inicial" name="medidor_inicial" type="text" class="form-control-disabled" disabled
                        value="{{ $abastecimento->medidor_inicial ?? '' }}">
                </div>
            </div>

            <div class="row mb-1">
                <label for="medidor_final" class="col-md-4 col-form-label text-md-end text-right">Medidor Final</label>
                <div class="col-md-6">
                    <input id="medidor_final" name="medidor_final" type="text" class="form-control-template" disabled
                        value="{{ $abastecimento->medidor_final }}">
                </div>
            </div>

            <div class="row mb-1">
                <label for="quantidade" class="col-md-4 col-form-label text-md-end text-right">Quantidade</label>
                <div class="col-md-6">
                    <input id="quantidade" type="text" class="form-control-template" name="quantidade" disabled
                        placeholder="Calcula automático (opcional)"
                        value="{{ $abastecimento->quantidade }}">
                </div>
            </div>

            <div class="row mb-1">
                <label for="horimetro_inicial" class="col-md-4 col-form-label text-md-end text-right">Horímetro
                    Inicial</label>
                <div class="col-md-6">
                    <input id="horimetro_inicial" name="horimetro_inicial" type="text" class="form-control-disabled"
                        disabled value="{{ $abastecimento->horimetro_inicial ?? old('horimetro_inicial') }}">
                </div>
            </div>
            <div class="row mb-1">
                <label for="horimetro" class="col-md-4 col-form-label text-md-end text-right">Horímetro Final</label>
                <div class="col-md-6">
                    <input id="horimetro_final" name="horimetro" type="text" class="form-control-template" disabled
                        value="{{ $abastecimento->horimetro }}">
                </div>
            </div>

            <div class="row mb-1">
                <label for="qtde_horimetro" class="col-md-4 col-form-label text-md-end text-right">Quantidade de
                    Horas</label>
                <div class="col-md-6">
                    <input id="qtde_horimetro" name="qtde_horimetro" type="text" class="form-control-disabled" disabled
                        value="{{ $total_horimetro }}">
                </div>
            </div>


        </div>
    </div>
@endsection
