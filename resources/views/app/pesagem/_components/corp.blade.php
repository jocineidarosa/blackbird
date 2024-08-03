@foreach ($pesagens as $pesagem)
                        <tr {{$pesagem->situacao == 'INCOMPLETO' ? 'class=bg-info' :''}}>
                            <th scope="row">{{ $pesagem->id }}</td>
                            <td>{{ Carbon\Carbon::parse($pesagem->data)->format('d/m/Y') }}</td>
                            <td>{{ $pesagem->placa }}</td>
                            <td>{{ $pesagem->sequencia }}</td>
                            <td>{{ $pesagem->parceiro }}</td>
                            <td>{{ $pesagem->produto }}</td>
                            <td>{{ $pesagem->motorista }}</td>
                            <td>{{ str_replace(',', '.', number_format($pesagem->peso_tara, 0)) }}</td>
                            <td>{{ str_replace(',', '.', number_format($pesagem->peso_bruto, 0)) }}</td>
                            <td>{{ str_replace(',', '.', number_format($pesagem->peso_liquido, 0)) }}</td>
                            <td>{{ $pesagem->movimentacao }}</td>
                            <td>{{ $pesagem->situacao }}</td>
                            <td>
                                <div {{-- class="div-op" --}} class="btn-group btn-group-actions visible-on-hover">
                                    <a class="btn btn-sm-template btn-outline-primary" target="_blank"
                                        href="{{ route('pesagem.show', ['pesagem' => $pesagem->id, 'quant_impress'=>'1']) }}">
                                        1
                                    </a>
                                    <a class="btn btn-sm-template btn-outline-primary" target="_blank"
                                        href="{{ route('pesagem.show', ['pesagem' => $pesagem->id, 'quant_impress'=>'2']) }}">
                                        2
                                    </a>
                                    <a class="btn btn-sm-template btn-outline-primary" target="_blank"
                                        href="{{ route('pesagem.show', ['pesagem' => $pesagem->id, 'quant_impress'=>'3']) }}">3
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @endforeach