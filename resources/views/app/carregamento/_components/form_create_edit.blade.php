            @if (isset($carregamento->id))
                <form action="{{ route('carregamento.update', ['carregamento' => $carregamento->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                @else
                    <form action="{{ route('carregamento.store') }}" method="POST">
                        @csrf
            @endif

            <div class="row mb-1">
                <label for="veiculo_id" class="col-md-4 col-form-label text-md-end text-right">Placa</label>

                <div class="col-md-6">
                    <select name="veiculo_id" id="" class="form-control-template">
                        <option value=""> --Selecione a placa--</option>
                        @foreach ($placas as $placa)
                            <option value="{{ $placa->id }}"
                                {{ ($carregamento->veiculo_id ?? old('veiculo_id')) == $placa->id ? 'selected' : '' }}>
                                {{ $placa->placa}}</option>
                        @endforeach
                    </select>
                    {{ $errors->has('veiculo_id') ? $errors->first('veiculo_id') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="hora_saida" class="col-md-4 col-form-label text-md-end text-right">Hora de Saída</label>
                <div class="col-md-6">
                    <input id="hora_saida" name="hora_saida" type="text" class="form-control-template" hora_saida="hora_saida"
                        value="{{ $carregamento->hora_saida ?? old('hora_saida') }}" required autocomplete="hora_saida">
                    {{ $errors->has('hora_saida') ? $errors->first('hora_saida') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="tracos" class="col-md-4 col-form-label text-md-end text-right">Traços</label>
                <div class="col-md-6">
                    <input name="tracos" id="tracos" type="text"
                        class="form-control-template "
                        tracos="tracos"
                        value="{{ $carregamento->tracos ?? old('tracos') }}">
                    {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}
                </div>
            </div>
            
            <div class="row mb-1">
                <label for="peso" class="col-md-4 col-form-label text-md-end text-right">Peso</label>
                <div class="col-md-6">
                    <input name="peso" id="peso" type="text"
                        class="form-control-template @error('peso') is-invalid @enderror"
                        peso="peso"
                        value="{{ $carregamento->peso ?? old('peso') }}">
                    {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <label for="observacao" class="col-md-4 col-form-label text-md-end text-right">Estoque Ideal</label>

                <div class="col-md-6">
                    <input name="observacao" id="observacao" type="text"
                        class="form-control-template "
                        observacao="observacao"
                        value="{{ $carregamento->observacao ?? old('observacao') }}">
                    {{ $errors->has('observacao') ? $errors->first('observacao') : '' }}
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($carregamento) ? 'Atualizar' : 'Cadastrar' }}
                    </button>
                </div>
            </div>
            </form>
