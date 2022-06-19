            @if (isset($transportadora->id))
                <form action="{{ route('transportadora.update', ['transportadora' => $transportadora->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                @else
                    <form action="{{ route('transportadora.store') }}" method="POST">
                        @csrf
            @endif

                <div class="row mb-3">
                    <label for="nome" class="col-md-4 col-form-label text-md-end text-right">Nome</label>

                    <div class="col-md-6">
                        <input id="nome" type="text" class="form-control-template" name="nome"
                            value="{{$transportadora->nome ?? old('nome') }}" required autocomplete="nome" autofocus>
                            {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                    </div>
                </div>


                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($transportadora) ? 'Atualizar' : 'Cadastrar' }}
                        </button>
                    </div>
                </div>
            </form>


