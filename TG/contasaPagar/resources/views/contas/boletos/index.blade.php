@extends('menu')
@section('title', 'Boletos')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title table-title">Boletos</h5>
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Sel.</th>
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
                            <th scope="row">
                                <input type="checkbox" class="chk">
                            </th>
                            <th scope="row">{{$boleto->id}}</th>
                            <td>{{$boleto->dt_emissao}}</td>
                            <td>{{$boleto->dt_vencimento}}</td>
                            <td>{{$boleto->status == 'A' ? 'À Pagar' : 'Pago'}}</td>
                            <td>{{$boleto->valor_documento}}</td>
                            <td>{{$boleto->juros}}</td>
                            <td>{{$boleto->multa}}</td>
                            <td>{{$boleto->juros + $boleto->valor_documento + $boleto->multa}}</td>
                            @if($boleto->dt_pagamento != null || $boleto->dt_pagamento != '')
                            <td>{{$boleto->dt_pagamento}}</td>
                            @else
                            <td style="text-align:center">-</td>
                            @endif
                            <td class="action-icons">
                                <a href="{{ route('contas.pagar', ['id'=>$boleto->id, 'redirect'=>'contas.boletos.index']) }}">
                                    <i class="fas fa-money-bill-wave" data-toggle="tooltip" data-placement="top"
                                        title="Pagar"></i>
                                </a>
                                <a href="{{ route('contas.boletos.destroy', ['id'=>$boleto->id]) }}" onclick="return confirm('Deseja excluir o registro ?')">
                                    <i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top"
                                        title="Excluir"></i>
                                </a>
                                <a href="{{ route('contas.boletos.edit', ['id'=>$boleto->id]) }}">
                                    <i class="far fa-edit" data-toggle="tooltip" data-placement="top"
                                        title="Editar"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

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
