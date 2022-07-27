            @if (isset($produto->id))
                <form action="{{ route('unidade-medida.update', ['unidade_medida' => $produto->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                @else
                    <form action="{{ route('unidade-medida.store') }}" method="POST">
                        @csrf
            @endif

            <div class="row mb-3">
                <label for="nome" class="col-md-4 col-form-label text-md-end text-right">Nome</label>

                <div class="col-md-6">
                    <input id="nome" type="text" class="form-control" name="nome"
                        value="{{ $unidade_medida->nome ?? old('nome') }}" required autocomplete="nome" autofocus>
                    {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                </div>
            </div>


            <div class="row mb-3">
                <label for="descricao" class="col-md-4 col-form-label text-md-end text-right">Descrição</label>

                <div class="col-md-6">
                    <input id="descricao" name="descricao" type="text" class="form-control" descricao="descricao"
                        value="{{ $unidade_medida->descricao ?? old('descricao') }}" required autocomplete="descricao"
                        autofocus>
                    {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($unidade_medida) ? 'Atualizar' : 'Cadastrar' }}
                    </button>
                </div>
            </div>
            </form>
