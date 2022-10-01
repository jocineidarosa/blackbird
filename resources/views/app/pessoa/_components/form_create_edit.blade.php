            @if (isset($veiculo->id))
                <form action="{{ route('pessoa.update', ['pessoa' => $pessoa->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                @else
                    <form action="{{ route('pessoa.store') }}" method="POST">
                        @csrf
            @endif

            <div class="row mb-1">
                <label for="nome" class="col-md-4 col-form-label text-md-end text-right">Nome</label>
                <div class="col-md-6">
                    <input id="nome" name="nome" type="text" class="form-control-template"
                        value="{{ $pessoa->nome ?? old('nome') }}" required autocomplete="nome">
                    {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="sobrenome" class="col-md-4 col-form-label text-md-end text-right">Sobrenome</label>
                <div class="col-md-6">
                    <input id="sobrenome" name="sobrenome" type="text" class="form-control-template"
                        value="{{ $pessoa->sobrenome ?? old('sobrenome') }}" required autocomplete="sobrenome">
                    {{ $errors->has('sobrenome') ? $errors->first('sobrenome') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="contato" class="col-md-4 col-form-label text-md-end text-right">contato</label>
                <div class="col-md-6">
                    <input id="contato" name="contato" type="text" class="form-control-template"
                        value="{{ $pessoa->contato ?? old('contato') }}" autocomplete="contato">
                    {{ $errors->has('contato') ? $errors->first('contato') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="cpf" class="col-md-4 col-form-label text-md-end text-right">CPF</label>
                <div class="col-md-6">
                    <input id="cpf" name="cpf" type="text" class="form-control-template" cpf="cpf"
                        value="{{ $pessoa->cpf ?? old('cpf') }}" autocomplete="cpf">
                    {{ $errors->has('cpf') ? $errors->first('cpf') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="rg" class="col-md-4 col-form-label text-md-end text-right">RG</label>
                <div class="col-md-6">
                    <input id="rg" name="rg" type="text" class="form-control-template" rg="rg"
                        value="{{ $pessoa->rg ?? old('rg') }}"autocomplete="rg">
                    {{ $errors->has('rg') ? $errors->first('rg') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="titulo_eleitor" class="col-md-4 col-form-label text-md-end text-right">Título de
                    Eleitor</label>
                <div class="col-md-6">
                    <input id="titulo_eleitor" name="titulo_eleitor" type="text" class="form-control-template"
                        value="{{ $pessoa->titulo_eleitor ?? old('titulo_eleitor') }}" autocomplete="titulo_eleitor">
                    {{ $errors->has('titulo_eleitor') ? $errors->first('titulo_eleitor') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="data_nascimento" class="col-md-4 col-form-label text-md-end text-right">Data de
                    Nascimento</label>
                <div class="col-md-6">
                    <input id="data_nascimento" name="data_nascimento" type="date" class="form-control-template"
                        value="{{ $pessoa->data_nascimento ?? old('data_nascimento') }}"
                        autocomplete="data_nascimento">
                    {{ $errors->has('data_nascimento') ? $errors->first('data_nascimento') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="endereco" class="col-md-4 col-form-label text-md-end text-right">Endereço</label>
                <div class="col-md-6">
                    <input id="endereco" name="endereco" type="text" class="form-control-template"
                        value="{{ $pessoa->endereco ?? old('endereco') }}" autocomplete="endereco">
                    {{ $errors->has('endereco') ? $errors->first('endereco') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="uf" class="col-md-4 col-form-label text-md-end text-right">Estado</label>
                <div class="col-md-6">
                    <select name="uf" id="uf" class="form-control-template">
                        <option value=""> --Selecione o Estado--</option>
                        @foreach ($ufs as $uf)
                            <option value="{{ $uf->id }}"
                                {{ ($uf->nome ?? old('uf')) == $uf->id ? 'selected' : '' }}>
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
                        @foreach ($cidades as $cidade)
                            <option value="{{ $cidade->id }}"
                                {{ ($produto->cidade_id ?? old('cidade_id')) == $cidade->id ? 'selected' : '' }}>
                                {{ $cidade->nome }} - {{ $cidade->uf->nome }} - {{ $cidade->uf->sigla }}</option>
                        @endforeach
                    </select>
                    {{ $errors->has('cidade_id') ? $errors->first('cidade_id') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($pessoa) ? 'Atualizar' : 'Cadastrar' }}
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
