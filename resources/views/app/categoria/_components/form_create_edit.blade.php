            @if (isset($produto->id))
                <form action="{{ route('category.update', ['produto' => $produto->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                @else
                    <form action="{{ route('category.store') }}" method="POST">
                    @csrf
            @endif

            <div class="row mb-3">
                <label for="nome" class="col-md-4 col-form-label text-md-end text-right">Nome</label>

                <div class="col-md-6">
                    <input id="nome" type="text" class="form-control" name="nome"
                        value="{{ $produto->nome ?? old('nome') }}" required autofocus>
                    {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                </div>
            </div>

            <div class="row mb-3">
                <label for="nome" class="col-md-4 col-form-label text-md-end text-right">Descrição</label>

                <div class="col-md-6">
                    <textarea id="descricao" class="form-control" name="descricao"
                        value="{{ $produto->descricao ?? old('descricao') }}" required>
                    </textarea>
                    {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}
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
