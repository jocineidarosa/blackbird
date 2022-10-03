@if (isset($funcionario->id))
    <form action="{{ route('funcionario.update', ['funcionario' => $funcionario->id]) }}" method="POST">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('funcionario.store') }}" method="POST">
            @csrf
@endif

<div class="row mb-1">
    <label for="nome_completo" class="col-md-4 col-form-label text-md-end text-right">Nome Completo</label>
    <div class="col-md-6">
        <input id="nome_completo" name="nome_completo" type="text" class="form-control-template"
             value="{{ $funcionario->nome_completo ?? old('nome_completo') }}" required
            autocomplete="nome_completo">
        {{ $errors->has('nome_completo') ? $errors->first('nome_completo') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="cpf" class="col-md-4 col-form-label text-md-end text-right">CPF</label>
    <div class="col-md-6">
        <input id="cpf" name="cpf" type="text" class="form-control-template"
            value="{{ $funcionario->cpf ?? old('cpf') }}" autocomplete="cpf">
        {{ $errors->has('cpf') ? $errors->first('cpf') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="rg" class="col-md-4 col-form-label text-md-end text-right">RG</label>
    <div class="col-md-6">
        <input id="rg" name="rg" type="text" class="form-control-template"
            value="{{ $funcionario->rg ?? old('rg') }}" autocomplete="rg">
        {{ $errors->has('rg') ? $errors->first('rg') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="num_registro" class="col-md-4 col-form-label text-md-end text-right">Registro</label>
    <div class="col-md-6">
        <input id="num_registro" name="num_registro" type="text" class="form-control-template"
            value="{{ $funcionario->num_registro ?? old('num_registro') }}"
            autocomplete="num_registro">
        {{ $errors->has('num_registro') ? $errors->first('num_registro') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="telefone" class="col-md-4 col-form-label text-md-end text-right">Telefone</label>
    <div class="col-md-6">
        <input id="telefone" name="telefone" type="text" class="form-control-template"
            value="{{ $funcionario->telefone ?? old('telefone') }}"
            autocomplete="telefone">
        {{ $errors->has('telefone') ? $errors->first('telefone') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="data_nascimento" class="col-md-4 col-form-label text-md-end text-right">Data de
        Nascimento</label>
    <div class="col-md-6">
        <input id="data_nascimento" name="data_nascimento" type="date" class="form-control-template"
            value="{{ $funcionario->data_nascimento ?? old('data_nascimento') }}"
            autocomplete="data_nascimento">
        {{ $errors->has('data_nascimento') ? $errors->first('data_nascimento') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="uf" class="col-md-4 col-form-label text-md-end text-right">Estado</label>
    <div class="col-md-6">
        <select name="uf" id="uf" class="form-control-template">
            <option value=""> --Selecione o Estado--</option>
            @foreach ($ufs as $uf)
                <option value="{{ $uf->id }}" {{ ($uf->nome ?? old('uf')) == $uf->id ? 'selected' : '' }}>
                    {{ $uf->nome }} - {{ $uf->sigla }}</option>
            @endforeach
        </select>
        {{ $errors->has('uf') ? $errors->first('uf') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="cidade_id" class="col-md-4 col-form-label text-md-end text-right">Cidade</label>
    <div class="col-md-6">
        <select name="cidade_id" id="cidade_id" class="form-control-template">
            {{--  o Javascript insere aqui os options de cidades relacionado ao estado selecionado previamente acima--}}
        </select>
        {{ $errors->has('cidade_id') ? $errors->first('cidade_id') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="endereco" class="col-md-4 col-form-label text-md-end text-right">Endereço</label>
    <div class="col-md-6">
        <input id="endereco" name="endereco" type="text" class="form-control-template"
            value="{{ $funcionario->endereco ?? old('endereco') }}"autocomplete="endereco">
        {{ $errors->has('endereco') ? $errors->first('endereco') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="data_admissao" class="col-md-4 col-form-label text-md-end text-right">Data Admissão</label>
    <div class="col-md-6">
        <input id="data_admissao" name="data_admissao" type="date" class="form-control-template"
            value="{{ $funcionario->data_admissao ?? old('data_admissao') }}"autocomplete="data_admissao">
        {{ $errors->has('data_admissao') ? $errors->first('data_admissao') : '' }}
    </div>
</div>

<div class="row mb-1">
    <label for="data_demissao" class="col-md-4 col-form-label text-md-end text-right">Data Demissão</label>
    <div class="col-md-6">
        <input id="data_demissao" name="data_demissao" type="date" class="form-control-template"
            value="{{ $funcionario->data_demissao ?? old('data_demissao') }}"autocomplete="data_demissao">
        {{ $errors->has('data_demissao') ? $errors->first('data_demissao') : '' }}
    </div>
</div>


<div class="row mb-1">
    <label for="salario" class="col-md-4 col-form-label text-md-end text-right">Salario</label>
    <div class="col-md-6">
        <input id="salario" name="salario" type="text" class="form-control-template"
            value="{{ $funcionario->salario ?? old('salario') }}"autocomplete="salario">
        {{ $errors->has('salario') ? $errors->first('salario') : '' }}
    </div>
</div>

<div class="row mb-1">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ isset($funcionario) ? 'Atualizar' : 'Cadastrar' }}
        </button>
    </div>
</div>
</form>

<script>
    /* Script Jquery */
    /* Busca as cidades correspondente ao estado selecionado */
    $(function() {
        $('#uf').change(function() {
            var uf = $("#uf option:selected").val();
            $.ajax({
                url: "{{ route('utils.get-cidade') }}",
                type: "get",
                data: {
                    'uf': uf,
                },
                dataType: "json",
                success: function(response) {
                    var options = '<option value="">---Selecione a Cidade---</option>';
                    for (var i = 0; i < response.length; i++) {
                        options += '<option value="' + response[i]['id'] + '">' + response[
                            i]['nome'] + '</option>';
                    }
                    $('#cidade_id').html(options);
                    $('#cidade_id').focus();
                }

            });

        })
    })
</script>
