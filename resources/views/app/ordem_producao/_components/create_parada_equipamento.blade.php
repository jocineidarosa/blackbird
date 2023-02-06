<div class="tab-pane fade {{ $tab_active == 'stop' ? 'show active' : '' }}" id="paradas_equip" role="tabpanel"
    aria-labelledby="paradas_equip_tab">
    <form
        action="{{ isset($ordem_producao) ? route('ordem-producao.store-parada', ['ordem_producao' => $ordem_producao]) : '#' }}"
        method="POST">
        @csrf
        <div class="row mb-1">
            <label for="hora_inicio" class="col-md-4 col-form-label text-md-end text-right">Hora
                Inicial</label>

            <div class="col-md-6">
                <input name="hora_inicio" id="hora_inicio" type="time" class="form-control">
            </div>
        </div>

        <div class="row mb-1">
            <label for="hora_fim" class="col-md-4 col-form-label text-md-end text-right">Hora
                Final</label>

            <div class="col-md-6">
                <input name="hora_fim" id="hora_fim" type="time" class="form-control">
            </div>
        </div>

        <div class="row mb-1">
            <label for="descricao" class="col-md-4 col-form-label text-md-end text-right">Descrição</label>
            <div class="col-md-6">
                <input name="descricao" id="descricao" type="text" class="form-control" descricao="descricao">
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Cadastrar </button>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-header-template">
            <div>LISTA DE PARADAS</div>
        </div>
        <div class="card-body">
            <table class="table-template table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="th-title">Hora Inicil</th>
                        <th scope="col" class="th-title">Hora final</th>
                        <th scope="col" class="th-title">Descrição</th>
                        <th scope="col" class="th-title">OPERAÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($paradas_equipamento)
                        @foreach ($paradas_equipamento as $parada_equipamento)
                            <tr>
                                <td>{{ $parada_equipamento->hora_inicio }}</td>
                                <td>{{ $parada_equipamento->hora_fim }}</td>
                                <td>{{ $parada_equipamento->descricao }}</td>
                                <td>
                                    <div class="btn-group btn-group-actions visible-on-hover">
                                        <a class="btn btn-sm-template btn-outline-primary" href="#"><i
                                                class="icofont-eye-alt"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-outline-success  @can('user') disabled @endcan"
                                            href="#">
                                            <i class="icofont-ui-edit"></i>
                                        </a>
                                        <a class="btn btn-sm-template btn-outline-danger" href="#"
                                            onclick="document.getElementById('form_{{ $parada_equipamento->id }}').submit()">
                                            <i class="icofont-ui-delete"></i>
                                        </a>
                                        <form id="form_{{ $parada_equipamento->id }}" method="post"
                                            action="{{ route('ordem-producao.destroy-parada-equipamento', [
                                                'parada_equipamento' => $parada_equipamento->id,
                                                'ordem_producao' => $ordem_producao->id,
                                            ]) }}">
                                            @method('DELETE')
                                            @csrf
                                        </form>


                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>

</div>
