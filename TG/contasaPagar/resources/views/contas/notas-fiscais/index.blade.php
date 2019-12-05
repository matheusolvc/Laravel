@extends('menu')
@section('title', 'Notas Fiscais')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title table-title">Notas Fiscais</h5>
                <a href="{{ route('contas.notas-fiscais.migrar') }}"
                class="btn btn-primary col-md-2" style="float:right; margin-bottom: 0.75em;">
                    Migrar
                </a>
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
                            @foreach ($notasFiscais as $notaFiscal)
                            <tr>
                                <th scope="row">{{$notaFiscal->id}}</th>
                                <td>{{date('d/m/Y', strtotime($notaFiscal->dt_emissao))}}</td>
                                <td>{{date('d/m/y', strtotime($notaFiscal->dt_vencimento))}}</td>
                                <td>{{$notaFiscal->status == 'A' ? 'Pendente' : 'Pago'}}</td>
                                <td>{{$notaFiscal->valor_documento}}</td>
                                <td>{{$notaFiscal->juros}}</td>
                                <td>{{$notaFiscal->multa}}</td>
                                <td>{{$notaFiscal->juros + $notaFiscal->valor_documento + $notaFiscal->multa}}</td>
                                @if($notaFiscal->dt_pagamento != null || $notaFiscal->dt_pagamento != '')
                                    <td>{{date('d/m/y', strtotime($notaFiscal->dt_pagamento))}}</td>
                                @else
                                    <td style="text-align:center">-</td>
                                @endif
                                <td class="action-icons">
                                    @if($notaFiscal->status == 'A')
                                        <a href="{{ route('contas.pagar', ['id'=>$notaFiscal->id, 'redirect'=>'contas.notas-fiscais.index']) }}">
                                            <i class="fas fa-money-bill-wave" data-toggle="tooltip" data-placement="top"
                                                title="Pagar"></i>
                                        </a>
                                        <a href="{{ route('contas.notas-fiscais.destroy', ['id'=>$notaFiscal->id]) }}" onclick="return confirm('Deseja excluir o registro ?')">
                                            <i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top"
                                                title="Excluir"></i>
                                        </a>
                                        <a href="{{ route('contas.notas-fiscais.edit', ['id'=>$notaFiscal->id]) }}">
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
                    {!! $notasFiscais->links() !!}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
