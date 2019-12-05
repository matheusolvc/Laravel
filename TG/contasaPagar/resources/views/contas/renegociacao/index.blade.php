@extends('menu')
@section('title', 'Renegociação')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title table-title">Renegociação</h5>
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
                                @foreach ($renegociacoes as $renegociacao)
                                <tr>
                                    <th scope="row">{{$renegociacao->id}}</th>
                                    <td>{{date('d/m/Y', strtotime($renegociacao->dt_emissao))}}</td>
                                    <td>{{date('d/m/Y', strtotime($renegociacao->dt_vencimento))}}</td>
                                    <td>@if($renegociacao->status == 'A') Pendente @elseif($renegociacao->status == 'P') Pago @elseif($renegociacao->status == 'E') Renegociado @endif</td>
                                    <td>{{$renegociacao->valor_documento}}</td>
                                    <td>{{$renegociacao->juros}}</td>
                                    <td>{{$renegociacao->multa}}</td>
                                    <td>{{$renegociacao->juros + $renegociacao->valor_documento + $renegociacao->multa}}</td>
                                    @if($renegociacao->dt_pagamento != null || $renegociacao->dt_pagamento != '')
                                    <td>{{date('d/m/Y', strtotime($renegociacao->dt_pagamento))}}</td>
                                    @else
                                    <td style="text-align:center">-</td>
                                    @endif
                                    <td class="action-icons">
                                    <a
                                        href="{{ route('contas.pagar', ['id'=>$renegociacao->id, 'redirect'=>'contas.renegociacao.index']) }}">
                                        <i class="fas fa-money-bill-wave" data-toggle="tooltip" data-placement="top"
                                            title="Pagar"></i>
                                    </a>
                                    <a href="{{ route('contas.renegociacao.destroy', ['id'=>$renegociacao->id]) }}"
                                        onclick="return confirm('Deseja excluir o registro ?')">
                                        <i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top"
                                            title="Excluir"></i>
                                    </a>
                                    <a href="{{ route('contas.renegociacao.edit', ['id'=>$renegociacao->id]) }}">
                                        <i class="far fa-edit" data-toggle="tooltip" data-placement="top"
                                            title="Editar"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- https://www.tutsmake.com/laravel-6-pagination-with-bootstrap-table-example/ --}}
                {{-- https://appdividend.com/2018/02/23/laravel-pagination-example-tutorial/ --}}
                <nav aria-label="pages" class="button-left">
                    {!! $renegociacoes->links() !!}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
