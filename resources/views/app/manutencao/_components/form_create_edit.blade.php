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
        <input id="data_inicio" type="text" class="form-control-template" name="data_inicio"
            value="{{ $manutencao->data_inicio ?? old('data_inicio') }}" required autocomplete="data_inicio" autofocus>
        {{ $errors->has('data_inicio') ? $errors->first('data_inicio') : '' }}
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
    <label for="marca_id" class="col-md-4 col-form-label text-md-end text-right">Marca</label>

    <div class="col-md-6">
        <select name="marca_id" id="" class="form-control-template">
            <option value=""> --Selecione a marca--</option>
            @foreach ($marcas as $marca)
                <option value="{{ $marca->id }}"
                    {{ ($manutencao->marca_id ?? old('marca_id')) == $marca->id ? 'selected' : '' }}>
                    {{ $marca->nome }}</option>
            @endforeach
        </select>
        {{ $errors->has('marca_id') ? $errors->first('marca_id') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="unidade_medida_id" class="col-md-4 col-form-label text-md-end text-right">Unidade de Medida</label>
    <div class="col-md-6">
        <select name="unidade_medida_id" id="" class="form-control-template">
            <option value=""> --Selecione a Unidade de Medida--</option>
            @foreach ($unidades as $unidade)
                <option value="{{ $unidade->id }}"
                    {{ ($manutencao->unidade_medida_id ?? old('unidade_medida_id')) == $unidade->id ? 'selected' : '' }}>
                    {{ $unidade->nome }}</option>
            @endforeach
        </select>
        {{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="categoria_id" class="col-md-4 col-form-label text-md-end text-right">Categoria</label>

    <div class="col-md-6">
        <select name="categoria_id" id="" class="form-control-template">
            <option value=""> --Selecione a Categoria--</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}"
                    {{ ($manutencao->categoria_id ?? old('categoria_id')) == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nome }}</option>
            @endforeach
        </select>
        {{ $errors->has('categoria_id') ? $errors->first('categoria_id') : '' }}
    </div>
</div>


<div class="row mb-1">
    <label for="estoque_minimo" class="col-md-4 col-form-label text-md-end text-right">Estoque Mínimo</label>

    <div class="col-md-6">
        <input name="estoque_minimo" id="estoque_minimo" type="text"
            class="form-control-template @error('estoque_minimo') is-invalid @enderror" estoque_minimo="estoque_minimo"
            value="{{ $manutencao->estoque_minimo ?? old('estoque_minimo') }}">
        {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="estoque_ideal" class="col-md-4 col-form-label text-md-end text-right">Estoque Ideal</label>

    <div class="col-md-6">
        <input name="estoque_ideal" id="estoque_ideal" type="text" class="form-control-template "
            estoque_ideal="estoque_ideal" value="{{ $manutencao->estoque_ideal ?? old('estoque_ideal') }}">
        {{ $errors->has('estoque_ideal') ? $errors->first('estoque_ideal') : '' }}
    </div>
</div>


<div class="row mb-1">
    <label for="estoque_maximo" class="col-md-4 col-form-label text-md-end text-right">Estoque Máximo</label>

    <div class="col-md-6">
        <input name="estoque_maximo" id="estoque_maximo" type="text"
            class="form-control-template @error('estoque_maximo') is-invalid @enderror" estoque_maximo="estoque_maximo"
            value="{{ $manutencao->estoque_maximo ?? old('estoque_maximo') }}">
        {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}

    </div>
</div>

<div class="row mb-1">
    <label for="lastro" class="col-md-4 col-form-label text-md-end text-right">Lastro</label>
    <div class="col-md-6">
        <input name="lastro" id="lastro" type="text" class="form-control-template " lastro="lastro"
            value="{{ $manutencao->lastro ?? old('lastro') }}">
        {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}

    </div>
</div>

<div class="row mb-1">
    <label for="teor_consumo" class="col-md-4 col-form-label text-md-end text-right">teor_consumo</label>
    <div class="col-md-6">
        <input name="teor_consumo" id="teor_consumo" type="text" class="form-control-template"
            value="{{ $manutencao->teor_consumo ?? old('teor_consumo') }}">
        {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}

    </div>
</div>

<div class="row mb-1">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ isset($manutencao) ? 'Atualizar' : 'Cadastrar' }}
        </button>
    </div>
</div>
</form>
