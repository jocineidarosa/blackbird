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
                    <a class="btn btn-primary btn-sm" href="{{ route('ordem-producao.index') }}">LISTAGEM</a>
                </div>
            </div>
            <div class="card-body">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="#dados_principais" class="nav-link active mr-1" id="dados_principais_tab"
                            data-bs-toggle="tab" role="tab" aria-controls="dados_principais">Dados Principais</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#recursos" class="nav-link mr-1 {{ isset($ordem_producao) ? '' : 'disabled' }}"
                            id="recursos_tab" data-bs-toggle="tab" role="tab" aria-controls="recursos">Recursos</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#paradas_equip" class="nav-link mr-1 {{ isset($ordem_producao) ? '' : 'disabled' }}"
                            id="paradas_equip_tab" data-bs-toggle="tab" role="tab" aria-controls="paradas_equip">
                            Paradas de
                            Equipamentos</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a href="#produto_obra" class="nav-link mr-1 {{ isset($ordem_producao) ? '' : 'disabled' }}"
                            id="produto_obra_tab" data-bs-toggle="tab" role="tab" aria-controls="produto_obra">Saída de
                            Produto para Obra</a>
                    </li>
                </ul>
                {{-- --------------------------------------------------------------------- --}}
                {{-- Dados Principais --}}
                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="dados_principais" role="tabpanel"
                        aria-labelledby="dados_principais_tab">
                        @if (!isset($ordem_producao))
                            <form action="{{ route('ordem-producao.store') }}" method="POST">
                                @csrf
                            @else
                                <form
                                    action="{{ route('ordem-producao.update', ['ordem_producao' => $ordem_producao->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                        @endif
                        <div class="row mb-1">
                            <label for="equipamento_id"
                                class="col-md-4 col-form-label text-md-end text-right">Equipamento</label>
                            <div class="col-md-6">
                                <select name="equipamento_id" id="equipamento_id" class="form-control-template" autofocus
                                    required>
                                    <option value=""> --Selecione o Equipamento--</option>
                                    @foreach ($equipamentos as $equipamento)
                                        <option value="{{ $equipamento->id }}"
                                            {{ ($ordem_producao->equipamento_id ?? old('equipamento_id')) == $equipamento->id ? 'selected' : '' }}>
                                            {{ $equipamento->nome ?? old('equipamento_id') }}
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
                                            {{ $produto->nome ?? old('equipamento_id') }}</option>
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
                                    value="{{ $ordem_producao->quantidade_producao ?? old('quantidade_producao') }}"
                                    required>
                                {{ $errors->has('quantidade_producao') ? $errors->first('quantidade_producao') : '' }}
                            </div>
                        </div>

                        <div class="row mb-1">
                            <label for="producao_hora" class="col-md-4 col-form-label text-md-end text-right">Produção
                                por Hora</label>
                            <div class="col-md-6">
                                <input name="producao_hora" id="producao_hora" type="text" class="form-control-disabled"
                                    readonly value="{{ old('producao_hora') }}">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="data" class="col-md-4 col-form-label text-md-end text-right">Data</label>
                            <div class="col-md-6">
                                <input name="data" id="data" type="date" class="form-control-template"
                                    value="{{ $ordem_producao->data ?? old('data') }}">
                                {{ $errors->has('data') ? $errors->first('data') : '' }}
                            </div>
                        </div>

                        <div class="row mb-1">
                            <label for="hora_inicio" class="col-md-4 col-form-label text-md-end text-right">Hora
                                Inicial</label>
                            <div class="col-md-6">
                                <input name="hora_inicio" id="hora_inicio" type="time" class="form-control-template"
                                    hora_inicio="hora_inicio"
                                    value="{{ $ordem_producao->hora_inicio ?? old('hora_inicio') }}">
                                {{ $errors->has('hora_inicio') ? $errors->first('hora_inicio') : '' }}
                            </div>
                        </div>

                        <div class="row mb-1">
                            <label for="hora_fim" class="col-md-4 col-form-label text-md-end text-right">Hora
                                Final</label>
                            <div class="col-md-6">
                                <input name="hora_fim" id="hora_fim" type="time" class="form-control-template"
                                    hora_fim="hora_fim" value="{{ $ordem_producao->hora_fim ?? old('hora_fim') }}">
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
                            <label for="horimetro_final" class="col-md-4 col-form-label text-md-end text-right">Horímetro
                                Final</label>

                            <div class="col-md-6">
                                <input name="horimetro_final" id="horimetro_final" class="form-control-template"
                                    value="{{ $ordem_producao->horimetro_final ?? old('horimetro_final') }}"
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
                                <select name="status_id" id="" class="form-control-template" required>
                                    <option value=""> --Selecione a Situação-</option>
                                    @foreach ($statuss as $status)
                                        <option value="{{ $status->id }}"
                                            {{ ($ordem_producao->status_id ?? old('status_id')) == $status->id ? 'selected' : '' }}>
                                            {{ $status->nome }}</option>
                                    @endforeach
                                </select>
                                {{ $errors->has('status_id') ? $errors->first('status_id') : '' }}

                            </div>

                        </div>

                        <div class="row mb-1">
                            <label for="observacao"
                                class="col-md-4 col-form-label text-md-end text-right">Observações</label>
                            <div class="col-md-6">
                                <textarea class="form-control text-left" name="observacao">
                                    {{ $ordem_producao->observacao ?? old('observacao') }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($ordem_producao) ? 'Atualizar' : 'Cadastrar' }}
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>

                    {{-- ----------------------------------------------------------------------------- --}}
                    {{-- Recursos de Produção --------------------------------------------------------- --}}

                    <div class="tab-pane fade mt-3" id="recursos" role="tabpanel" aria-labelledby="recursos-tab">
                        <form
                            action="{{ isset($ordem_producao) ? route('ordem-producao.store-recursos', ['ordem_producao' => $ordem_producao->id]) : '#' }}"
                            method="POST">
                            @csrf
                            <div class="row mb-1">
                                <label for="equipamento_recursos"
                                    class="col-md-4 col-form-label text-md-end text-right">Equipamento</label>
                                <div class="col-md-6">
                                    <select name="equipamento_recursos" id="equipamento_recursos" class="form-control"
                                        autofocus>
                                        <option value=""> --Selecione o Equipamento--</option>
                                        @foreach ($equipamentos as $equipamento)
                                            <option value="{{ $equipamento->id }}">
                                                {{ $equipamento->nome }}</option>
                                        @endforeach
                                    </select>
                                    {{ $errors->has('equipamento_recursos') ? $errors->first('equipamento_recursos') : '' }}
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
                                <label for="horimetro_inicial_recursos"
                                    class="col-md-4 col-form-label text-md-end text-right">Horímetro Inicial</label>
                                <div class="col-md-6">
                                    <input name="horimetro_inicial_recursos" id="horimetro_inicial_recursos"
                                        type="text" class="form-control-disabled" disabled>
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
                                <label for="data" class="col-md-4 col-form-label text-md-end text-right">Data</label>
                                <div class="col-md-6">
                                    <input name="data" id="data" type="date" class="form-control"
                                        value="{{ $ordem_producao->data ?? old('data') }}">
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

                        <div class="card">
                            <div class="card-header-template">
                                <div>Recursos de Produção</div>
                            </div>
                            <div class="card-body">
                                <table class="table-template table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="th-title">Id</th>
                                            <th scope="col" class="th-title">Equipamento</th>
                                            <th scope="col" class="th-title">Produto</th>
                                            <th scope="col" class="th-title">Quant</th>
                                            <th scope="col" class="th-title">Horm. Final</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @isset($recursos_producao)
                                            @foreach ($recursos_producao as $recurso_producao)
                                                <tr>
                                                    <th scope="row">{{ $recurso_producao->id }}</td>
                                                    <td>{{ $recurso_producao->equipamento->nome ?? '' }}</td>
                                                    <td>{{ $recurso_producao->produto->nome }}</td>
                                                    <td>{{ $recurso_producao->quantidade }}</td>
                                                    <td>{{ $recurso_producao->horimetro_final ?? '' }}</td>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>

                    {{-- ---------------------------------------------------------------------------------- --}}
                    {{-- Paradas de Equipamento --}}
                    <div class="tab-pane fade" id="paradas_equip" role="tabpanel" aria-labelledby="paradas_equip_tab">
                        <form
                            action="{{ isset($ordem_producao) ? route('ordem-producao.store-parada', ['ordem_producao' => $ordem_producao]) : '#' }}"
                            method="POST">
                            @csrf
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

                        <div class="card">
                            <div class="card-header-template">
                                <div>LISTA DE PARADAS</div>
                            </div>
                            <div class="card-body">
                                <table class="table-template table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="th-title">Hora Inicil</th>
                                            <th scope="col" class="th-title">Hora final</th>
                                            <th scope="col" class="th-title">Descrição</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($paradas_equipamento)
                                            @foreach ($paradas_equipamento as $parada_equipamento)
                                                <tr>
                                                    <td>{{ $parada_equipamento->hora_inicio }}</td>
                                                    <td>{{ $parada_equipamento->hora_fim }}</td>
                                                    <td>{{ $parada_equipamento->descricao }}</td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>



                    </div>

                    {{-- --------------------------------------------------------------------------------------------------- --}}
                    {{-- Saida Materiais --}}
                    <div class="tab-pane fade" id="produto_obra" role="tabpanel" aria-labelledby="produto_obra_tab">
                        <form
                            action="{{ isset($ordem_producao) ? route('ordem-producao.store-produto-obra', ['ordem_producao' => $ordem_producao]) : '#' }}"
                            method="POST">
                            @csrf

                            <div class="row mb-1">
                                <label for="obra_id" class="col-md-4 col-form-label text-md-end text-right">Obra</label>
                                <div class="col-md-6">
                                    <select name="obra_id" id="obra_id" class="form-control-template" required
                                        autofocus>
                                        <option value=""> --Selecione a Obra--</option>
                                        @foreach ($obras as $obra)
                                            <option value="{{ $obra->id }}"
                                                {{ ($ordem_producao->obra_id ?? old('obra_id')) == $obra->id ? 'selected' : '' }}>
                                                {{ $obra->nome ?? old('obra_id') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{ $errors->has('obra_id') ? $errors->first('obra_id') : '' }}
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="produto_id"
                                    class="col-md-4 col-form-label text-md-end text-right">Produto</label>
                                <div class="col-md-6">
                                    <select name="produto_id" id="produto_id" class="form-control-template" required
                                        autofocus>
                                        <option value=""> --Selecione o Produto--</option>
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto->id }}"
                                                {{ ($ordem_producao->produto_id ?? old('produto_id')) == $produto->id ? 'selected' : '' }}>
                                                {{ $produto->nome ?? old('produto_id') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="quantidade"
                                    class="col-md-4 col-form-label text-md-end text-right">Quantidade</label>
                                <div class="col-md-6">
                                    <input name="quantidade" id="quantidade" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="qtde_cargas"
                                    class="col-md-4 col-form-label text-md-end text-right">Qtde Cargas</label>
                                <div class="col-md-6">
                                    <input name="qtde_cargas" id="qtde_cargas" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="transportadora_id"
                                    class="col-md-4 col-form-label text-md-end text-right">Transportadora</label>
                                <div class="col-md-6">
                                    <select name="transportadora_id" id="transportadora_id" class="form-control-template"
                                        required autofocus>
                                        <option value=""> --Selecione o Produto--</option>
                                        @foreach ($transportadoras as $transportadora)
                                            <option value="{{ $transportadora->id }}"
                                                {{ ($ordem_producao->transportadora_id ?? old('transportadora_id')) == $transportadora->id ? 'selected' : '' }}>
                                                {{ $transportadora->nome ?? old('transportadora_id') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{ $errors->has('transportadora_id') ? $errors->first('transportadora_id') : '' }}
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Cadastrar </button>
                                </div>
                            </div>

                        </form>

                        <div class="card">
                            <div class="card-header-template">
                                <div>SAIDA DE MATERIAL PARA OBRA</div>
                            </div>
                            <div class="card-body">
                                <table class="table-template table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="th-title">OBRA</th>
                                            <th scope="col" class="th-title">PRODUTO</th>
                                            <th scope="col" class="th-title">QUANTIDADE</th>
                                            <th scope="col" class="th-title">QTDE CARGAS</th>
                                            <th scope="col" class="th-title">TRANSPORTADORA</th>
                                            <th scope="col" class="th-title">OPERAÇÕES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($produtos_obra)
                                            @foreach ($produtos_obra as $produto_obra)
                                                <tr>
                                                    <td>{{ $produto_obra->obra->nome }}</td>
                                                    <td>{{ $produto_obra->produto->nome }}</td>
                                                    <td>{{ $produto_obra->quantidade }}</td>
                                                    <td>{{ $produto_obra->qtde_cargas }}</td>
                                                    <td>{{ $produto_obra->transportadora->nome ?? '' }}</td>
                                                    <td>
                                                        <div class="div-op">
                                                            <a class="btn btn-sm-template btn-primary mx-1"
                                                                href="#"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                            <a class="btn btn-sm-template btn-success mx-1"
                                                                href="#"><i
                                                                    class="icofont-pen-alt-1"></i></a>
                                                            <form id="form_{{ $produto_obra->id }}" method="post"
                                                                action="{{route('ordem-producao.destroy_produto_obra',[
                                                                'produto_obra'=>$produto_obra->id,
                                                                'ordem_producao'=>$ordem_producao->id])}}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <a class="btn btn-sm-template btn-danger mx-1" href="#"
                                                                    onclick="document.getElementById('form_{{$produto_obra->id}}').submit()"><i
                                                                        class="icofont-close-squared-alt"></i></a>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>
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

            $('#equipamento_recursos').change(function() {
                var equipamento_id = $("#equipamento_recursos option:selected").val();
                $("#horimetro_inicial_recursos").val('');
                $.ajax({
                    url: "{{ route('utils.get-horimetro-inicial') }}",
                    type: "get",
                    data: {
                        'equipamento_id': equipamento_id,
                        'table': 'recursos_producao'
                    },
                    dataType: "json",
                    success: function(response) {
                        $("#horimetro_inicial_recursos").val(response);
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
            document.getElementById("data").value = data_atual;
        }
    </script>

@endsection
{{-- -------------- --}}
