<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Relatório de Contas à Pagar</title>

        <style>
            .table {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

                .table td, .table th {
                border: 1px solid #ddd;
                padding: 8px;
                }

                .table tr:nth-child(even){background-color: #f2f2f2;}

                .table tr:hover {background-color: #ddd;}

                .table th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #673bb7;
                color: white;
                }
        </style>
    </head>
    <body>
        <h1>Relatório de Contas à Pagar</h1>
        <h4>Por: {{ $request->data_de == 'dt_vencimento' ? 'Vencimento' : 'Emissão' }} - Data: {{ date('d/m/Y', strtotime($request->dt_inicial)) }} até {{ date('d/m/Y', strtotime($request->dt_final)) }}</h4>
        <table class="table">
            <thead style="border: 1px solid black">
                <tr>
                    <th>Nº</th>
                    <th>Dt. Emissão</th>
                    <th>Dt. Vencimento</th>
                    <th>Valor</th>
                    <th>Juros</th>
                    <th>Multa</th>
                    <th>Total</th>
                    <th>Dt. Pagamento</th>
                    <th>Situação</th>
                    <th>Dias</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dados as $dado)
                <tr>
                    <th>{{$dado->id}}</th>
                    <td>{{date('d/m/Y', strtotime($dado->dt_emissao))}}</td>
                    <td>{{date('d/m/Y', strtotime($dado->dt_vencimento))}}</td>
                    <td>{{$dado->valor_documento}}</td>
                    <td>{{$dado->juros}}</td>
                    <td>{{$dado->multa}}</td>
                    <td>{{$dado->juros + $dado->valor_documento + $dado->multa}}</td>
                    @if($dado->dt_pagamento != null || $dado->dt_pagamento != '')
                        <td>{{date('d/m/Y', strtotime($dado->dt_pagamento))}}</td>
                    @else
                        <td style="text-align:center">-</td>
                    @endif
                    @if (\Carbon\Carbon::now()->format('Y-m-d') > date('Y-m-d', strtotime($dado->dt_vencimento)))
                        <td style="color:red">Vencido</td>
                    @else
                        <td>A Vencer</td>
                    @endif
                    <td>
                        @php
                            if(\Carbon\Carbon::now()->format('Y-m-d') > date('Y-m-d', strtotime($dado->dt_vencimento))) {
                                $dado->dt_vencimento;
                                $data = \Carbon\Carbon::now()->diff($dado->dt_vencimento);

                                echo '<p style="color:red">'.$data->d.'</p>';
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
    </body>
</html>
