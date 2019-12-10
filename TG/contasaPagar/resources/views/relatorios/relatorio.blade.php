<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Relatório de Contas à Pagar</title>

       {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    </head>
    <body>
        <h1 class="text-center">Relatório de Contas à Pagar</h1>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nº</th>
                        <th scope="col">Dt. Emissão</th>
                        <th scope="col">Dt. Vencimento</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Juros</th>
                        <th scope="col">Multa</th>
                        <th scope="col">Total</th>
                        <th scope="col">Dt. Pagamento</th>
                        <th scope="col">Situação</th>
                        <th scope="col">Dias</th>
                        <th scope="col">Observação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dados as $dado)
                    <tr>
                        <th scope="row">{{$dado->id}}</th>
                        <td>{{date('d/m/Y', strtotime($dado->dt_emissao))}}</td>
                        <td>{{date('d/m/Y', strtotime($dado->dt_vencimento))}}</td>
                        <td class="">{{$dado->valor_documento}}</td>
                        <td class="">{{$dado->juros}}</td>
                        <td class="">{{$dado->multa}}</td>
                        <td class="">{{$dado->juros + $dado->valor_documento + $dado->multa}}</td>
                        @if($dado->dt_pagamento != null || $dado->dt_pagamento != '')
                            <td>{{date('d/m/Y', strtotime($dado->dt_pagamento))}}</td>
                        @else
                            <td style="text-align:center">-</td>
                        @endif
                        @if ($dado->dt_vencimento > \Carbon\Carbon::now())
                            <td class="text-danger">Vencido</td>
                        @else
                            <td>À Vencer</td>
                        @endif
                        <td>
                            @php
                                if($dado->dt_vencimento > \Carbon\Carbon::now()) {
                                    $dado->dt_vencimento;
                                    $data = \Carbon\Carbon::now()->diff($dado->dt_vencimento);

                                    echo '<p class="text-danger">'.$data->d.'</p>';
                                } else {
                                    echo '-';
                                }
                            @endphp
                        </td>
                        <td>{{ $dado->observacao }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
            integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
        </script> --}}
    </body>
</html>
