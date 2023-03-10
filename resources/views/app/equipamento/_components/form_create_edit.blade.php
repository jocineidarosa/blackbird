@if (isset($equipamento->id))
<form action="{{ route('equipamento.update', ['equipamento' => $equipamento->id]) }}" method="POST">
    @csrf
    @method('PUT')
@else
    <form action="{{ route('equipamento.store') }}" method="POST">
        @csrf
@endif

<div class="row mb-1">
    <label for="nome" class="col-md-4 col-form-label text-md-end">Nome</label>

    <div class="col-md-6">
        <input id="nome" type="text" class="form-control-template" name="nome"
            value="{{$equipamento->nome ?? old('nome') }}" required autocomplete="nome" autofocus>
            {{ $errors->has('nome') ? $errors->first('nome') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="descricao" class="col-md-4 col-form-label text-md-end">Descrição</label>

    <div class="col-md-6">
        <input id="descricao" name="descricao" type="text" class="form-control-template" descricao="descricao"
            value="{{$equipamento->descricao?? old('descricao') }}" required autocomplete="descricao" autofocus>
            {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}                            
    </div>
</div>

<div class="row mb-1">
    <label for="marca_id" class="col-md-4 col-form-label text-md-end">Marca</label>

    <div class="col-md-6">
        <select name="marca_id" id="" class="form-control-template">
            <option value=""> --Selecione a marca--</option>
            @foreach ($marcas as $marca)
                <option value="{{$marca->id}}"
                    {{ ($equipamento->marca_id ?? old('marca_id')) == $marca->id ? 'selected' : '' }}>{{$marca->nome}}
                </option>
            @endforeach
        </select>
        {{ $errors->has('marca_id') ? $errors->first('marca_id') : '' }} 
    </div>
</div>

<div class="row mb-1">
    <label for="equipamento_pai" class="col-md-4 col-form-label text-md-end">Equipamento Pai</label>

    <div class="col-md-6">
        <select name="equipamento_pai" id="" class="form-control-template">
            <option value=""> --Selecione o equipamento_pai--</option>
            @foreach ($equipamentos as $equipment)
                <option value="{{$equipment->id}}"  {{ ($equipamento->equipamento_pai ?? old('equipamento_pai')) == $equipment->id ? 'selected' : '' }}>{{$equipment->nome}}</option>
            @endforeach
        </select>
        {{ $errors->has('equipamento_pai') ? $errors->first('equipamento_pai') : '' }} 
    </div>
</div>


<div class="row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ isset($equipamento) ? 'Atualizar' : 'Cadastrar' }}
        </button>
    </div>
</div>
</form>

