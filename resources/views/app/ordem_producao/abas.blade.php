@extends('app.layouts.app')

@section('titulo', 'Marcas')

@section('content')
    <main class="content">
        <div class="card">
            <div class="card-header-template">
                <div>
                    Cadastro de Ordem de Serviço
                </div>
                <div>
                    <a class="btn btn-primary btn-sm" href="{{ route('marca.create') }}">NOVO</a>
                </div>
            </div>
            <div class="card-body">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="#dados_principais" class="nav-link active mr-1" id="dados_principais_tab"
                            data-bs-toggle="tab" role="tab" aria-controls="dados_principais">Dados Principais</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#recursos" class="nav-link mr-1" id="recursos_tab" data-bs-toggle="tab"
                            role="tab" aria-controls="recursos">Recursos</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#paradas_equip" class="nav-link mr-1" id="paradas_equip_tab"
                            data-bs-toggle="tab" role="tab" aria-controls="paradas_equip">Paradas de Equipamentos</a>
                    </li>
                </ul>
                {{-- --------------------------------------------------------------------- --}}
                {{-- Dados Principais --}}
                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="dados_principais" role="tabpanel"
                        aria-labelledby="dados_principais_tab">
                        <form action="{{ route('ordem-producao.store') }}" method="POST">
                            @csrf
                            <div class="row mb-1">
                                <label for="equipamento_id"
                                    class="col-md-4 col-form-label text-md-end text-right">Equipamento</label>
                                <div class="col-md-6">
                                    <select name="equipamento_id" id="equipamento_id" class="form-control-template" required
                                        autofocus>
                                        <option value=""> --Selecione o Equipamento--</option>
                                        @foreach ($equipamentos as $equipamento)
                                            <option value="{{ $equipamento->id }}"
                                                {{ ($ordem_producao->equipamento_id ?? old('equipamento_id')) == $equipamento->id ? 'selected' : '' }}>
                                                {{ $equipamento->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{ $errors->has('equipamento_id') ? $errors->first('equipamento_id') : '' }}
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="produto" class="col-md-4 col-form-label text-md-end text-right">Produto</label>

                                <div class="col-md-6">
                                    <select name="produto_id" id="" class="form-control-template" required>
                                        <option value=""> --Selecione o Produto-</option>
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto->id }}"
                                                {{ ($ordem_producao->produto_id ?? old('produto_id')) == $produto->id ? 'selected' : '' }}>
                                                {{ $produto->nome }}</option>
                                        @endforeach
                                    </select>
                                    {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="quantidade_producao"
                                    class="col-md-4 col-form-label text-md-end text-right">Quantidade_producao</label>

                                <div class="col-md-6">
                                    <input name="quantidade_producao" id="quantidade_producao" type="text"
                                        class="form-control-template " quantidade_producao="quantidade_producao"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        value="{{ $produto->quantidade_producao ?? old('quantidade_producao') }}"
                                        required placeholder="Somente Números">
                                    {{ $errors->has('quantidade_producao') ? $errors->first('quantidade_producao') : '' }}
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="producao_hora" class="col-md-4 col-form-label text-md-end text-right">Produção
                                    por Hora</label>
                                <div class="col-md-6">
                                    <input name="producao_hora" id="producao_hora" type="text" class="form-control-disabled"
                                        disabled>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="data_inicio" class="col-md-4 col-form-label text-md-end text-right">Data
                                    Inicial</label>

                                <div class="col-md-6">
                                    <input name="data_inicio" id="data_inicio" type="date" class="form-control-template "
                                        data_inicio="data_inicio"
                                        value="{{ \Carbon\Carbon::now() ?? old('data_inicio') }}">
                                    {{ $errors->has('data_inicio') ? $errors->first('data_inicio') : '' }}
                                </div>
                            </div>


                            <div class="row mb-1">
                                <label for="data_fim" class="col-md-4 col-form-label text-md-end text-right">Data
                                    Final</label>

                                <div class="col-md-6">
                                    <input name="data_fim" id="data_fim" type="date" class="form-control-template"
                                        data_fim="data_fim" value="{{ $produto->data_fim ?? old('data_fim') }}"
                                        autofocus>
                                    {{ $errors->has('data_fim') ? $errors->first('data_fim') : '' }}

                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="hora_inicio" class="col-md-4 col-form-label text-md-end text-right">Hora
                                    Inicial</label>

                                <div class="col-md-6">
                                    <input name="hora_inicio" id="hora_inicio" type="time" class="form-control-template"
                                        hora_inicio="hora_inicio"
                                        value="{{ $produto->hora_inicio ?? old('hora_inicio') }}" autofocus>
                                    {{ $errors->has('hora_inicio') ? $errors->first('hora_inicio') : '' }}

                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="hora_fim" class="col-md-4 col-form-label text-md-end text-right">Hora
                                    Final</label>
                                <div class="col-md-6">
                                    <input name="hora_fim" id="hora_fim" type="time" class="form-control-template"
                                        hora_fim="hora_fim" value="{{ $produto->hora_fim ?? old('hora_fim') }}"
                                        autofocus>
                                    {{ $errors->has('hora_fim') ? $errors->first('hora_fim') : '' }}

                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="horimetro_inicial"
                                    class="col-md-4 col-form-label text-md-end text-right">Horímetro Inicial</label>
                                <div class="col-md-6">
                                    <input name="horimetro_inicial" id="horimetro_inicial" readonly
                                        class="form-control-disabled"
                                        value="{{ $produto->horimetro_inicial ?? old('horimetro_inicial') }}">
                                    {{ $errors->has('horimetro_inicial') ? $errors->first('horimetro_inicial') : '' }}

                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="horimetro_final"
                                    class="col-md-4 col-form-label text-md-end text-right">Horímetro
                                    Final</label>

                                <div class="col-md-6">
                                    <input name="horimetro_final" id="horimetro_final" class="form-control-template"
                                        value="{{ $produto->horimetro_final ?? old('horimetro_final') }}"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                    {{ $errors->has('horimetro_final') ? $errors->first('horimetro_final') : '' }}
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="total_horimetro" class="col-md-4 col-form-label text-md-end text-right">Total
                                    Horimetro</label>
                                <div class="col-md-6">
                                    <input name="total_horimetro" id="total_horimetro" type="text"
                                        class="form-control-disabled" disabled>
                                </div>
                            </div>


                            <div class="row mb-1">
                                <label for="observacao"
                                    class="col-md-4 col-form-label text-md-end text-right">Situaçao</label>
                                <div class="col-md-6">
                                    <select name="produto_id" id="" class="form-control-template" required>
                                        <option value=""> --Selecione a Situação-</option>
                                        @foreach ($statuss as $status)
                                            <option value="{{ $status->id }}"
                                                {{ ($ordem_producao->produto_id ?? old('produto_id')) == $status->id ? 'selected' : '' }}>
                                                {{ $status->nome }}</option>
                                        @endforeach
                                    </select>
                                    {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}

                                </div>

                            </div>





                            <div class="row mb-1">
                                <label for="observacao"
                                    class="col-md-4 col-form-label text-md-end text-right">Observações</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="observacao"></textarea>
                                </div>

                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- ----------------------------------------------------------------------------- --}}
                    {{-- Recursos de Produção --------------------------------------------------------- --}}

                    <div class="tab-pane fade mt-3" id="recursos" role="tabpanel" aria-labelledby="recursos-tab">
                        <form action="#}}" method="post">
                            @csrf

                            <div class="row mb-1">
                                <label for="equipamento_id"
                                    class="col-md-4 col-form-label text-md-end text-right">Equipamento</label>
                                <div class="col-md-6">
                                    <select name="equipamento_id" id="equipamento_id" class="form-control" autofocus>
                                        <option value=""> --Selecione o Equipamento--</option>
                                        @foreach ($equipamentos as $equipamento)
                                            <option value="{{ $equipamento->id }}">
                                                {{ $equipamento->nome }}</option>
                                        @endforeach
                                    </select>
                                    {{ $errors->has('equipamento_id') ? $errors->first('equipamento_id') : '' }}
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="produto" class="col-md-4 col-form-label text-md-end text-right">Material
                                    Utilizado</label>

                                <div class="col-md-6">
                                    <select name="produto_id" id="" class="form-control" required>
                                        <option value=""> --Selecione o Material-</option>
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto->id }}">
                                                {{ $produto->nome }}</option>
                                        @endforeach
                                    </select>
                                    {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="quantidade" class="col-md-4 col-form-label text-md-end text-right">Qtde.
                                    Material
                                    Utilizado</label>

                                <div class="col-md-6">
                                    <input name="quantidade" id="quantidade" type="number" class="form-control "
                                        quantidade="quantidade" value="{{ $produto->quantidade ?? old('quantidade') }}"
                                        required>
                                    {{ $errors->has('quantidade') ? $errors->first('quantidade') : '' }}
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="horimetro_inicial"
                                    class="col-md-4 col-form-label text-md-end text-right">Horímetro Inicial</label>
                                <div class="col-md-6">
                                    <input name="horimetro_inicial" id="horimetro_inicial" type="text"
                                        class="form-control-disabled" disabled>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="horimetro_final"
                                    class="col-md-4 col-form-label text-md-end text-right">Horímetro Final</label>
                                <div class="col-md-6">
                                    <input name="horimetro_final" id="horimetro_final" type="text"
                                        class="form-control-template">
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="total_horimetro"
                                    class="col-md-4 col-form-label text-md-end text-right">Horímetro Total</label>
                                <div class="col-md-6">
                                    <input name="total_horimetro" id="total_horimetro" type="text"
                                        class="form-control-disabled" disabled>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="data_inicio" class="col-md-4 col-form-label text-md-end text-right">Data
                                    Inicial</label>

                                <div class="col-md-6">
                                    <input name="data_inicio" id="data_inicio" type="date" class="form-control "
                                        data_inicio="data_inicio">
                                </div>
                            </div>


                            <div class="row mb-1">
                                <label for="data_fim" class="col-md-4 col-form-label text-md-end text-right">Data
                                    Final</label>

                                <div class="col-md-6">
                                    <input name="data_fim" id="data_fim" type="date" class="form-control"
                                        data_fim="data_fim" value="{{ $ordem_producao->data_fim ?? old('data_fim') }}">
                                    {{ $errors->has('data_fim') ? $errors->first('data_fim') : '' }}

                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="hora_inicio" class="col-md-4 col-form-label text-md-end text-right">Hora
                                    Inicial</label>

                                <div class="col-md-6">
                                    <input name="hora_inicio" id="hora_inicio" type="time" class="form-control"
                                        hora_inicio="hora_inicio"
                                        value="{{ $ordem_producao->hora_inicio ?? old('hora_inicio') }}">
                                    {{ $errors->has('hora_inicio') ? $errors->first('hora_inicio') : '' }}

                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="hora_fim" class="col-md-4 col-form-label text-md-end text-right">Hora
                                    Final</label>

                                <div class="col-md-6">
                                    <input name="hora_fim" id="hora_fim" type="time" class="form-control"
                                        hora_fim="hora_fim" value="{{ $ordem_producao->hora_fim ?? old('hora_fim') }}">
                                    {{ $errors->has('hora_fim') ? $errors->first('hora_fim') : '' }}

                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Cadastrar </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="paradas_equip" role="tabpanel" aria-labelledby="paradas_equip_tab">
                        <form action="#" method="POST">
                            @csrf

                            <div class="row mb-1">
                                <label for="data" class="col-md-4 col-form-label text-md-end text-right">Data</label>

                                <div class="col-md-6">
                                    <input name="data" id="data" type="date" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="hora_inicio" class="col-md-4 col-form-label text-md-end text-right">Hora
                                    Inicial</label>

                                <div class="col-md-6">
                                    <input name="hora_inicio" id="hora_inicio" type="time" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="hora_fim" class="col-md-4 col-form-label text-md-end text-right">Hora
                                    Final</label>

                                <div class="col-md-6">
                                    <input name="hora_fim" id="hora_fim" type="time" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="descricao"
                                    class="col-md-4 col-form-label text-md-end text-right">Descrição</label>

                                <div class="col-md-6">
                                    <input name="descricao" id="descricao" type="text" class="form-control"
                                        descricao="descricao">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Cadastrar </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

        </div>


    </main>

    <script>
        $(function() {
            $('#equipamento_id').change(function() {
                var equipamento_id = $("#equipamento_id option:selected").val();
                $("#horimetro_inicial").val('');
                $.ajax({
                    url: "{{ route('utils.get-horimetro-inicial') }}",
                    type: "get",
                    data: {
                        'equipamento_id': equipamento_id,
                        'table': 'ordens_producoes'
                    },
                    dataType: "json",
                    success: function(response) {
                        $("#horimetro_inicial").val(response);
                    }
                })

            });

            $('#horimetro_final').change(function() {
                var horimetro_inicial = $('#horimetro_inicial').val();
                var horimetro_final = $('#horimetro_final').val();
                var total_horimetro = (horimetro_final - horimetro_inicial).toFixed(2);
                var quant_producao = $('#quantidade_producao').val();
                $('#total_horimetro').val(total_horimetro);
                var producao_hora = (quant_producao / total_horimetro).toFixed(0);
                $('#producao_hora').val(producao_hora);


            });

            $('#quantidade_producao').change(function() {
                var horimetro_inicial = $('#horimetro_inicial').val();
                var horimetro_final = $('#horimetro_final').val();
                var total_horimetro = (horimetro_final - horimetro_inicial).toFixed(2);
                var quant_producao = $('#quantidade_producao').val();
                $('#total_horimetro').val(total_horimetro);
                var producao_hora = (quant_producao / total_horimetro).toFixed(0);
                $('#producao_hora').val(producao_hora);

            });
        });

        // executa quando a pagina é carregada

        window.onload = function() {
            let data_atual = new Date();
            var dia = String(data_atual.getDate()).padStart(2, '0');
            var mes = String(data_atual.getMonth() + 1).padStart(2, '0');
            var ano = data_atual.getFullYear();
            data_atual = ano + '-' + mes + '-' + dia;
            document.getElementById("data_inicio").value = data_atual;
            document.getElementById("data_fim").value = data_atual;
        }
    </script>

@endsection
{{-- -------------- --}}
