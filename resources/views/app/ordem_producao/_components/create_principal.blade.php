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
                <select name="produto_id" id="produto_id_principal" class="form-control-template" required>
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
                    disabled value="{{ old('producao_hora') }}">
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
                <input name="horimetro_inicial" id="horimetro_inicial" disabled
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
                <button type="submit" class="btn btn-primary" id="btCadPrincipal">
                    {{ isset($ordem_producao) ? 'Atualizar' : 'Cadastrar' }}
                </button>
            </div>
        </div>
        </form>
    </div>