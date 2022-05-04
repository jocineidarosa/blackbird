            @if (isset($produto->id))
                <form action="{{ route('cliente.update', ['entrada_produto' => $cliente->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                @else
                    <form action="{{ route('cliente.store') }}" method="POST">
                        @csrf
            @endif

            <div class="row mb-1">
                <label for="empresa_id" class="col-md-4 col-form-label text-md-end text-right">Pessoa Jurídica</label>
                <div class="col-md-6">
                    <select name="empresa_id" id="empresa" class="form-control-template">
                        <option value=""> --Selecione a Pessoa Jurídica--</option>
                        @foreach ($empresas as $empresa)
                            <option value="{{ $empresa->id }}"
                                {{ ($empresa->empresa_id ?? old('empresa_id')) == $empresa->id ? 'selected' : '' }}>
                                {{ $empresa->razao_social }}  -  {{$empresa->nome_fantasia}}</option>
                        @endforeach
                    </select>
                    {{ $errors->has('empresa_id') ? $errors->first('empresa_id') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="pessoa_id" class="col-md-4 col-form-label text-md-end text-right">Pessoa Física</label>
                <div class="col-md-6">
                    <select name="pessoa_id" id="" class="form-control-template">
                        <option value=""> --Selecione a Pessoa Física--</option>
                        @foreach ($pessoas as $pessoa)
                            <option value="{{ $pessoa->id }}"
                                {{ ($pessoa->pessoa_id ?? old('pessoa_id')) == $pessoa->id ? 'selected' : '' }}>
                                {{ $pessoa->nome}} {{$pessoa->sobrenome}} - {{$pessoa->cpf}}</option>
                        @endforeach
                    </select>
                    {{ $errors->has('pessoa_id') ? $errors->first('pessoa_id') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="data_inicio" class="col-md-4 col-form-label text-md-end text-right">Data Inicio</label>
                <div class="col-md-6">
                    <input class="form-control-template" type="date" name="data_inicio" id="data_inicio">
                </div>
            </div>




            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($cliente) ? 'Atualizar' : 'Cadastrar' }}
                    </button>
                </div>
            </div>
            </form>
