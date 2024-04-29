@extends('app.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header-template">
            <div>Cadastro de Equipamentos</div>
            <div>
                <a class="btn btn-sm btn-primary" href="{{ route('equipamento.index') }}" class="btn">
                    LISTAGEM
                </a>
            </div>
        </div>

        <div class="card-body">

            <div class="row mb-1">
                <label for="nome" class="col-md-4 col-form-label text-md-end">Nome</label>

                <div class="col-md-6">
                    <input id="nome" type="text" class="form-control-template" name="nome"
                        value="{{ $equipamento->nome }}" disabled>
                </div>
            </div>

            <div class="row mb-1">
                <label for="descricao" class="col-md-4 col-form-label text-md-end">Descrição</label>
                <div class="col-md-6">
                    <input id="descricao" name="descricao" type="text" class="form-control-template"
                        descricao="descricao" value="{{ $equipamento->descricao }}" disabled>
                </div>
            </div>

            <div class="row mb-1">
                <label for="marca" class="col-md-4 col-form-label text-md-end">Marca</label>
                <div class="col-md-6">
                    <input id="marca" name="marca" type="text" class="form-control-template" marca="marca"
                        value="{{ $equipamento->marca->nome }}" disabled>
                </div>
            </div>

            <div class="row mb-1">
                <label for="modelo" class="col-md-4 col-form-label text-md-end">Modelo</label>
                <div class="col-md-6">
                    <input id="modelo" name="modelo" type="text" class="form-control-template"
                        value="{{ $equipamento->modelo }}" disabled>
                </div>
            </div>

            <div class="row mb-1">
                <label for="potencia" class="col-md-4 col-form-label text-md-end">Potência</label>
                <div class="col-md-6">
                    <input id="potencia" name="potencia" type="text" class="form-control-template"
                        value="{{ $equipamento->potencia }}" disabled>
                </div>
            </div>

            <div class="row mb-1">
                <label for="tipo_potencia" class="col-md-4 col-form-label text-md-end">Tipo de potência</label>
                <div class="col-md-6">
                    <input id="tipo_potencia" name="tipo_potencia" type="text" class="form-control-template"
                        value="{{ $equipamento->tipo_potencia }}" disabled>
                </div>
            </div>

            <div class="row mb-1">
                <label for="ano_fabricacao" class="col-md-4 col-form-label text-md-end">Ano Fabricação</label>
                <div class="col-md-6">
                    <input id="ano_fabricacao" name="ano_fabricacao" type="text" class="form-control-template"
                        value="{{ $equipamento->ano_fabricacao }}" disabled>
                </div>
            </div>

            <div class="row mb-1">
                <label for="tipo_combustivel" class="col-md-4 col-form-label text-md-end">Tipo de Combustivel</label>
                <div class="col-md-6">
                    <input id="tipo_combustivel" name="tipo_combustivel" type="text" class="form-control-template"
                        value="{{ $equipamento->tipo_combustivel }}" disabled>
                </div>
            </div>

            <div class="row mb-1">
                <label for="equipamento_pai" class="col-md-4 col-form-label text-md-end">Equipamento Pai</label>
                <div class="col-md-6">
                    <input id="equipamento_pai" name="equipamento_pai" type="text" class="form-control-template"
                        value="{{ $equipamento->equipamento_pai }}" disabled>
                </div>
            </div>

            <div class="row mb-1">
                <label for="controle_consumo" class="col-md-4 col-form-label text-md-end">Controle de
                    consumo</label>{{-- sim: é gerado consumo no abastecimento --}}
                <div class="col-md-6">
                    <input id="controle_consumo" name="controle_consumo" type="text" class="form-control-template"
                        value="{{ $equipamento->controle_consumo==1 ? "SIM" : "NÃO" }}" disabled>
                </div>
            </div>


            <div class="row mb-1">
                <label for="capacidade_tanque" class="col-md-4 col-form-label text-md-end">Capacidade do Tanque</label>
                <div class="col-md-6">
                    <input id="capacidade_tanque" name="capacidade_tanque" type="text" class="form-control-template"
                        value="{{ $equipamento->capacidade_tanque }}" disabled>
                </div>
            </div>

            <div class="row mb-1">
                <label for="controle_saida" class="col-md-4 col-form-label text-md-end">Saída ao abastecer?</label>
                <div class="col-md-6">
                    <input id="controle_saida" name="controle_saida" type="text" class="form-control-template"
                        value="{{ $equipamento->controle_said==1 ? "NÃO" : "SIM" }}" disabled>
                </div>
            </div>

            <div class="row mb-1">
                <label for="cod_fiscal" class="col-md-4 col-form-label text-md-end">Código Fiscal</label>
                <div class="col-md-6">
                    <input id="cod_fiscal" name="cod_fiscal" type="text" class="form-control-template"
                        value="{{ $equipamento->cod_fiscal }}" disabled>
                </div>
            </div>

            <div class="row mb-1">
                <label for="cod_operacao" class="col-md-4 col-form-label text-md-end">Código de Operacao</label>
                <div class="col-md-6">
                    <input id="cod_operacao" name="cod_operacao" type="text" class="form-control-template"
                        value="{{ $equipamento->cod_operacao }}" disabled>
                </div>
            </div>


        </div>
    </div>

    </main>
@endsection
