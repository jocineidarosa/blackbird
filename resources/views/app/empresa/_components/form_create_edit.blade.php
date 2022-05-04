@if (isset($produto->id))
<form action="{{ route('fornecedor.update', ['fornecedor' => $empresas->id]) }}" method="POST">
    @csrf
    @method('PUT')
@else
    <form action="{{ route('fornecedor.store') }}" method="POST">
        @csrf
@endif

<div class="row mb-1">
    <label for="nome" class="col-md-4 col-form-label text-md-end text-right">Razão Social</label>

    <div class="col-md-6">
        <input id="razao_social" type="text" class="form-control" name="razao_social"
            value="{{$empresa->razao_social ?? old('razao_social') }}" required autofocus>
            {{ $errors->has('razao_social') ? $errors->first('razao_social') : '' }}
    </div>
</div>


<div class="row mb-1">
    <label for="nome_fantasia" class="col-md-4 col-form-label text-md-end text-right">Nome Fantasia</label>
    <div class="col-md-6">
        <input id="nome_fantasia" name="nome_fantasia" type="text" class="form-control" nome_fantasia="nome_fantasia"
            value="{{$empresa->nome_fantasia?? old('nome_fantasia') }}" required>
            {{ $errors->has('nome_fantasia') ? $errors->first('nome_fantasia') : '' }}                            
    </div>
</div>

<div class="row mb-1">
    <label for="cnpj" class="col-md-4 col-form-label text-md-end text-right">CNPJ</label>

    <div class="col-md-6">
        <input id="cnpj" name="cnpj" type="text" class="form-control" cnpj="cnpj"
            value="{{$empresa->cnpj?? old('cnpj') }}" required>
            {{ $errors->has('cnpj') ? $errors->first('cnpj') : '' }}                            
    </div>
</div>

<div class="row mb-1">
    <label for="insc_estadual" class="col-md-4 col-form-label text-md-end text-right">Inscrição Estadual</label>
    <div class="col-md-6">
        <input id="insc_estadual" name="insc_estadual" type="text" class="form-control" insc_estadual="insc_estadual"
            value="{{$empresa->insc_estadual?? old('insc_estadual') }}" required>
            {{ $errors->has('insc_estadual') ? $errors->first('insc_estadual') : '' }}                            
    </div>
</div>

<div class="row mb-1">
    <label for="endereco" class="col-md-4 col-form-label text-md-end text-right">Endereço</label>
    <div class="col-md-6">
        <input id="endereco" name="endereco" type="text" class="form-control" endereco="endereco"
            value="{{$empresa->endereco?? old('endereco') }}" required >
            {{ $errors->has('endereco') ? $errors->first('endereco') : '' }}                            
    </div>
</div>


<div class="row mb-1">
    <label for="bairro" class="col-md-4 col-form-label text-md-end text-right">Bairro</label>

    <div class="col-md-6">
        <input id="bairro" name="bairro" type="text" class="form-control" bairro="bairro"
            value="{{$empresa->bairro?? old('bairro') }}" required>
            {{ $errors->has('bairro') ? $errors->first('bairro') : '' }}                            
    </div>
</div>

<div class="row mb-1">
    <label for="cidade_id" class="col-md-4 col-form-label text-md-end text-right">Cidade</label>
    <div class="col-md-6">
        <select name="cidade_id" id="" class="form-control-template">
            <option value=""> --Selecione a Cidade--</option>
            @foreach ($cidades as $cidade)
                <option value="{{ $cidade->id }}"
                    {{ ($produto->cidade_id ?? old('cidade_id')) == $cidade->id ? 'selected' : '' }}>
                    {{ $cidade->nome }} - {{$cidade->uf->nome}} - {{$cidade->uf->sigla}}</option>
            @endforeach
        </select>
        {{ $errors->has('cidade_id') ? $errors->first('cidade_id') : '' }}
    </div>
</div>


<div class="row mb-1">
    <label for="telefone" class="col-md-4 col-form-label text-md-end text-right">Telefone</label>

    <div class="col-md-6">
        <input id="telefone" name="telefone" type="text" class="form-control" telefone="telefone"
            value="{{$empresa->telefone?? old('telefone') }}" required>
            {{ $errors->has('telefone') ? $errors->first('telefone') : '' }}                            
    </div>
</div>

<div class="row mb-1">
    <label for="contato" class="col-md-4 col-form-label text-md-end text-right">Contato</label>

    <div class="col-md-6">
        <input id="contato" name="contato" type="text" class="form-control" contato="contato"
            value="{{$empresa->contato?? old('contato') }}" required >
            {{ $errors->has('contato') ? $errors->first('contato') : '' }}                            
    </div>
</div>

<div class="row mb-1">
    <label for="email" class="col-md-4 col-form-label text-md-end text-right">Email</label>

    <div class="col-md-6">
        <input id="email" name="email" type="text" class="form-control" email="email"
            value="{{$empresa->email?? old('email') }}" required>
            {{ $errors->has('email') ? $errors->first('email') : '' }}                            
    </div>
</div>

<div class="row mb-1">
    <label for="site" class="col-md-4 col-form-label text-md-end text-right">Site</label>
    <div class="col-md-6">
        <input id="site" name="site" type="text" class="form-control" site="site"
            value="{{$empresa->site?? old('site') }}" required >
            {{ $errors->has('site') ? $errors->first('site') : '' }}                            
    </div>
</div>



<div class="row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ isset($produto) ? 'Atualizar' : 'Cadastrar' }}
        </button>
    </div>
</div>
</form>


