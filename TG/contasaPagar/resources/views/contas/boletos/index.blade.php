@extends('menu')
@section('title', 'Boletos')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title table-title">Boletos</h5>
                <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nº</th>
                            <th scope="col">Dt. Emissão</th>
                            <th scope="col">Dt. Vencimento</th>
                            <th scope="col">Status</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Juros</th>
                            <th scope="col">Multa</th>
                            <th scope="col">Total</th>
                            <th scope="col">Dt. Pagamento</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($boletos as $boleto)
                        <tr>
                            <th scope="row">{{$boleto->id}}</th>
                            <td>{{date('d/m/Y', strtotime($boleto->dt_emissao))}}</td>
                            <td>{{date('d/m/Y', strtotime($boleto->dt_vencimento))}}</td>
                            <td>@if($boleto->status == 'A') Pendente @elseif($boleto->status == 'P') Pago @elseif($boleto->status == 'E') Renegociado @endif</td>
                            <td>{{$boleto->valor_documento}}</td>
                            <td>{{$boleto->juros}}</td>
                            <td>{{$boleto->multa}}</td>
                            <td>{{$boleto->juros + $boleto->valor_documento + $boleto->multa}}</td>
                            @if($boleto->dt_pagamento != null || $boleto->dt_pagamento != '')
                            <td>{{date('d/m/Y', strtotime($boleto->dt_pagamento))}}</td>
                            @else
                            <td style="text-align:center">-</td>
                            @endif
                            <td class="action-icons">
                                @if($boleto->status == 'A')
                                    @if(Auth::user()->tipo_usuario == 'G')
                                        <a href="{{ route('contas.pagar', ['id'=>$boleto->id, 'redirect'=>'contas.boletos.index']) }}">
                                            <i class="fas fa-money-bill-wave" data-toggle="tooltip" data-placement="top"
                                                title="Pagar"></i>
                                        </a>
                                    <a href="{{ route('contas.renegociacao.create', ['id'=>$boleto->id, 'route'=>'"contas.boletos.index", ["route" => contas.boletos.index]']) }}">
                                            <i class="fas fa-handshake" data-toggle="tooltip" data-placement="top"
                                                title="Renegociar"></i>
                                        </a>

                                    @endif
                                    <a href="{{ route('contas.boletos.destroy', ['id'=>$boleto->id]) }}" onclick="return confirm('Deseja excluir o registro ?')">
                                        <i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top"
                                            title="Excluir"></i>
                                    </a>
                                    <a href="{{ route('contas.boletos.edit', ['id'=>$boleto->id]) }}">
                                        <i class="far fa-edit" data-toggle="tooltip" data-placement="top"
                                            title="Editar"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                {{-- https://www.tutsmake.com/laravel-6-pagination-with-bootstrap-table-example/ --}}
                {{-- https://appdividend.com/2018/02/23/laravel-pagination-example-tutorial/ --}}
                <nav aria-label="pages" class="button-left">
                    {!! $boletos->links() !!}
                </nav>
                <a href="{{route('contas.boletos.create') }}" class="btn btn-success button-right btn-new">Novo</a>
            </div>
        </div>
    </div>
</div>
@endsection
