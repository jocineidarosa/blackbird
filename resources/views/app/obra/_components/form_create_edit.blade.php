            @if (isset($obra->id))
                <form action="{{ route('obra.update', ['obra' => $obra->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                @else
                    <form action="{{ route('obra.store') }}" method="POST">
                        @csrf
            @endif

                <div class="row mb-3">
                    <label for="nome" class="col-md-4 col-form-label text-md-end text-right">Nome</label>

                    <div class="col-md-6">
                        <input id="nome" type="text" class="form-control-template" name="nome"
                            value="{{$obra->nome ?? old('nome') }}" required autocomplete="nome" autofocus>
                            {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                    </div>
                </div>


                <div class="row mb-1">
                    <label for="empresa_id" class="col-md-4 col-form-label text-md-end text-right">Empresa</label>
                    <div class="col-md-6">
                        <select name="empresa_id" id="" class="form-control-template">
                            <option value=""> --Selecione a Empresa--</option>
                            @foreach ($empresas as $empresa)
                                <option value="{{$empresa->id}}"  {{ ($obra->empresa_id ?? old('empresa_id')) == $empresa->id ? 'selected' : '' }}>{{$empresa->nome_fantasia}}</option>
                            @endforeach
                        </select>
                        {{ $errors->has('empresa_id') ? $errors->first('empresa_id') : '' }} 
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="endereco" class="col-md-4 col-form-label text-md-end text-right">Endereço</label>
                    <div class="col-md-6">
                        <input id="endereco" name="endereco" type="text" class="form-control-template" endereco="endereco"
                            value="{{$obra->endereco?? old('endereco') }}" required autocomplete="endereco">
                            {{ $errors->has('endereco') ? $errors->first('endereco') : '' }}                            
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($obra) ? 'Atualizar' : 'Cadastrar' }}
                        </button>
                    </div>
                </div>
            </form>


