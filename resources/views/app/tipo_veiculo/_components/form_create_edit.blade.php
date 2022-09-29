            @if (isset($tipo_veiculo->id))
                <form action="{{ route('tipo-veiculo.update', ['tipo-veiculo' => $tipo_veiculo->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                @else
                    <form action="{{ route('tipo-veiculo.store') }}" method="POST">
                    @csrf
                @endif
            
            <div class="row mb-1">
                <label for="descricao" class="col-md-4 col-form-label text-md-end text-right">Descrição</label>
                <div class="col-md-6">
                    <input id="descricao" name="descricao" type="text" class="form-control-template" descricao="descricao"
                        value="{{ $tipo_veiculo->descricao ?? old('descricao') }}" required autocomplete="descricao">
                    {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}
                </div>
            </div>
           
            <div class="row mb-1">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($tipo_veiculo) ? 'Atualizar' : 'Cadastrar' }}
                    </button>
                </div>
            </div>
            </form>
