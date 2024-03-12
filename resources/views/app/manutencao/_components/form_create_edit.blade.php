@if (isset($manutencao->id))
    <form action="{{ route('manutencao.update', ['manutencao' => $manutencao->id]) }}" method="POST">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('manutencao.store') }}" method="POST">
            @csrf
@endif

<div class="row mb-1">
    <label for="data_inicio" class="col-md-4 col-form-label text-md-end text-right">Data Inicial</label>
    <div class="col-md-6">
        <input id="data_inicio" type="date" class="form-control-template" name="data_inicio"
            value="{{ $manutencao->data_inicio ?? old('data_inicio') }}" required autocomplete="data_inicio" autofocus>
        {{ $errors->has('data_inicio') ? $errors->first('data_inicio') : '' }}
    </div>
</div>



<div class="row mb-1">
    <label for="hora_inicio" class="col-md-4 col-form-label text-md-end text-right">Hora Inicial</label>
    <div class="col-md-6">
        <input id="hora_inicio" type="time" class="form-control-template" name="hora_inicio"
            value="{{ $manutencao->hora_inicio ?? old('hora_inicio') }}" required autocomplete="hora_inicio" autofocus>
        {{ $errors->has('hora_inicio') ? $errors->first('hora_inicio') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="data_fim" class="col-md-4 col-form-label text-md-end text-right">Data Final</label>
    <div class="col-md-6">
        <input id="data_fim" type="date" class="form-control-template" name="data_fim"
            value="{{ $manutencao->data_fim ?? old('data_fim') }}" required>
        {{ $errors->has('data_fim') ? $errors->first('data_fim') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="hora_fim" class="col-md-4 col-form-label text-md-end text-right">Hora Final</label>
    <div class="col-md-6">
        <input id="hora_fim" type="time" class="form-control-template" name="hora_fim"
            value="{{ $manutencao->hora_fim ?? old('hora_fim') }}" required>
        {{ $errors->has('hora_fim') ? $errors->first('hora_fim') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="equipamento_id" class="col-md-4 col-form-label text-md-end text-right">Equipamento</label>
    <div class="col-md-6">
        <select name="equipamento_id" id="" class="form-control-template">
            <option value=""> --Selecione o equipamento--</option>
            @foreach ($equipamentos as $equipamento)
                <option value="{{ $equipamento->id }}"
                    {{ ($produto->equipamento_id ?? old('equipamento_id')) == $equipamento->id ? 'selected' : '' }}>
                    {{ $equipamento->nome }}</option>
            @endforeach
        </select>
        {{ $errors->has('equipamento_id') ? $errors->first('equipamento_id') : '' }}
    </div>
</div>


<div class="row mb-1">
    <label for="descricao" class="col-md-4 col-form-label text-md-end text-right">Descrição</label>

    <div class="col-md-6">
        <input id="descricao" name="descricao" type="text" class="form-control-template" descricao="descricao"
            value="{{ $manutencao->descricao ?? old('descricao') }}" required autocomplete="descricao" autofocus>
        {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="tipo_manutencao" class="col-md-4 col-form-label text-md-end text-right">Tipo de Manutenção</label>
    <div class="col-md-6">
        <select name="tipo_manutencao" id="" class="form-control-template">
            <option value=""> --Selecione o tipo--</option>
            <option value="0">CORRETIVA</option>
            <option value="1">PREVENTIVA</option>
            <option value="2">PREDITIVA</option>
        </select>
        {{ $errors->has('tipo_manutencao') ? $errors->first('tipo_manutencao') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="funcionario_id" class="col-md-4 col-form-label text-md-end text-right">Manutentores</label>
    <div class="col-md-6" id="maintainers">
        <select name="maintainers" id="" class="form-control-template" onchange="addMaintainerField(this)">
            <option value=""> --Selecione o manutentor--</option>
            @foreach ($funcionarios as $funcionario)
                <option value="{{ $funcionario->id }}">
                    {{ $funcionario->nome_completo }}
                </option>
            @endforeach
        </select>
        {{ $errors->has('funcionario_id') ? $errors->first('funcionario_id') : '' }}
    </div>
</div>
<div id="selected-maintainers">
    <!-- Aqui serão adicionados os inputs para cada manutentor selecionado -->
</div>


<div class="row mb-1">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ isset($manutencao) ? 'Atualizar' : 'Cadastrar' }}
        </button>
    </div>
</div>
</form>

<script>
    function addMaintainerField(select) {
        const selectedOption = select.options[select.selectedIndex];
        if (selectedOption.value !== '') {
            const selectedMaintainerDiv = document.createElement('div');
            selectedMaintainerDiv.className = 'selected-maintainer';
            selectedMaintainerDiv.innerHTML = `
                <input type="hidden" name="selected_maintainers[]" value="${selectedOption.value}">
                        <input id="manutentor" type="text"  name="manutentor"
                        value="${selectedOption.text}">
            `;
            document.getElementById('maintainers').appendChild(selectedMaintainerDiv);
            select.selectedIndex = 0;
        }
    }
</script>