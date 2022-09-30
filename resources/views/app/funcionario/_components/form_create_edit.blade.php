            @if (isset($funcionario->id))
                <form action="{{ route('funcionario.update', ['funcionario' => $funcionario->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                @else
                    <form action="{{ route('funcionario.store') }}" method="POST">
                        @csrf
            @endif

            <div class="row mb-1">
                <label for="pessoa_id" class="col-md-4 col-form-label text-md-end text-right">Nome</label>
                <div class="col-md-6">
                    <select name="pessoa_id" id="" class="form-control-template">
                        <option value=""> --Selecione a placa--</option>
                        @foreach ($pessoas as $pessoa)
                            <option value="{{ $pessoa->id }}"
                                {{ ($funcionario->pessoa_id ?? old('pessoa_id')) == $pessoa->id ? 'selected' : '' }}>
                                {{ $pessoa->nome.' '.$pessoa->sobrenome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="row mb-1">
                <label for="num_registro" class="col-md-4 col-form-label text-md-end text-right">Registro</label>
                <div class="col-md-6">
                    <input id="num_registro" name="num_registro" type="text" class="form-control-template" num_registro="num_registro"
                        value="{{ $funcionario->num_registro ?? old('num_registro') }}" required autocomplete="num_registro">
                    {{ $errors->has('num_registro') ? $errors->first('num_registro') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="data_admissao" class="col-md-4 col-form-label text-md-end text-right">Data Demissao</label>
                <div class="col-md-6">
                    <input id="data_admissao" name="data_admissao" type="date" class="form-control-template" data_admissao="data_admissao"
                        value="{{ $funcionario->data_admissao ?? old('data_admissao') }}" required autocomplete="data_admissao">
                    {{ $errors->has('data_admissao') ? $errors->first('data_admissao') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="data_demissao" class="col-md-4 col-form-label text-md-end text-right">Data Demissão</label>
                <div class="col-md-6">
                    <input id="data_demissao" name="data_demissao" type="date" class="form-control-template"
                        value="{{ $funcionario->data_demissao ?? old('data_demissao') }}" required autocomplete="data_demissao">
                    {{ $errors->has('data_demissao') ? $errors->first('data_demissao') : '' }}
                </div>
            </div>


            <div class="row mb-1">
                <label for="salario" class="col-md-4 col-form-label text-md-end text-right">Salario</label>
                <div class="col-md-6">
                    <input id="salario" name="salario" type="text" class="form-control-template" salario="salario"
                        value="{{ $funcionario->salario ?? old('salario') }}" required autocomplete="salario">
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
