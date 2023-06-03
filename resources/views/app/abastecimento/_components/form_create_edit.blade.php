
@if (isset($abastecimento->id))
    <form action="{{ route('abastecimento.update', ['abastecimento' => $abastecimento->id]) }}" method="POST">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('abastecimento.store') }}" method="POST">
            @csrf
@endif

<div class="row mb-1">
    <label for="equipamento_id" class="col-md-4 col-form-label text-md-end text-right">Equipamento</label>
    <div class="col-md-6">
        <select name="equipamento_id" id="" class="form-control-template">
            <option value=""> --equipamento--</option>
            @foreach ($equipamentos as $equipamento)
                <option value="{{ $equipamento->id }}"
                    {{ ($abastecimento->equipamento_id ?? old('equipamento_id')) == $equipamento->id ? 'selected' : '' }}>
                    {{ $equipamento->nome . '    |    ' . $equipamento->cod_operacao }}</option>
            @endforeach
        </select>
        {{ $errors->has('equipamento_id') ? $errors->first('equipamento_id') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="produto_id" class="col-md-4 col-form-label text-md-end text-right">Produto</label>

    <div class="col-md-6">
        <select name="produto_id" id="" class="form-control-template">
            <option value=""> --Selecione o produto--</option>
            @foreach ($produtos as $produto)
                <option value="{{ $produto->id }}"
                    {{ ($abastecimento->produto_id ?? old('produto_id')) == $produto->id ? 'selected' : '' }}>
                    {{ $produto->nome }}</option>
            @endforeach
        </select>
        {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="quantidade" class="col-md-4 col-form-label text-md-end text-right">Quantidade</label>
    <div class="col-md-6">
        <input id="quantidade" type="text" class="form-control-template" name="quantidade"
            value="{{ $abastecimento->quantidade ?? old('quantidade') }}" required>
        {{ $errors->has('quantidade') ? $errors->first('quantidade') : '' }}
    </div>
</div>


<div class="row mb-1">
    <label for="data" class="col-md-4 col-form-label text-md-end text-right">Data</label>

    <div class="col-md-6">
        <input id="data" name="data" type="date" class="form-control-template"
            value="{{ $abastecimento->data ?? old('data') }}">
        {{ $errors->has('data') ? $errors->first('data') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="medidor_inicial" class="col-md-4 col-form-label text-md-end text-right">Medidor Inicial</label>
    <div class="col-md-6">
        <input id="medidor_inicial" name="medidor_inicial" type="text" class="form-control-template"
            value="{{ $abastecimento->medidor_inicial ?? old('medidor_inicial') }}">
        {{ $errors->has('medidor_inicial') ? $errors->first('medidor_inicial') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="medidor_final" class="col-md-4 col-form-label text-md-end text-right">Medidor Final</label>
    <div class="col-md-6">
        <input id="medidor_final" name="medidor_final" type="text" class="form-control-template"
            value="{{ $abastecimento->medidor_final ?? old('medidor_final') }}">
        {{ $errors->has('medidor_final') ? $errors->first('medidor_final') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="horimetro" class="col-md-4 col-form-label text-md-end text-right">Horímetro</label>
    <div class="col-md-6">
        <input id="horimetro" name="horimetro" type="text" class="form-control-template"
            value="{{ $abastecimento->horimetro ?? old('horimetro') }}">
        {{ $errors->has('horimetro') ? $errors->first('horimetro') : '' }}
    </div>
</div>

<div class="row mb-1">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ isset($abastecimento) ? 'Atualizar' : 'Cadastrar' }}
        </button>
    </div>
</div>
</form>
