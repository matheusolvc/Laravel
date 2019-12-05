@extends('menu')
@section('title', 'Outras contas')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title table-title">Outras contas</h5>
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
                        @foreach ($outrasContas as $outras)
                        <tr>
                            <th scope="row">
                                <input type="checkbox" class="chk">
                            </th>
                            <th scope="row">{{$outras->id}}</th>
                            <td>{{$outras->dt_emissao}}</td>
                            <td>{{$outras->dt_vencimento}}</td>
                            <td>{{$outras->status == 'A' ? 'À Pagar' : 'Pago'}}</td>
                            <td>{{$outras->valor_documento}}</td>
                            <td>{{$outras->juros}}</td>
                            <td>{{$outras->multa}}</td>
                            <td>{{$outras->juros + $outras->valor_documento + $outras->multa}}</td>
                            @if($outras->dt_pagamento != null || $outras->dt_pagamento != '')
                            <td>{{$outras->dt_pagamento}}</td>
                            @else
                            <td style="text-align:center">-</td>
                            @endif
                            <td class="action-icons">

                                <a href="{{ route('contas.pagar', ['id'=>$outras->id, 'redirect'=>'contas.outras.index']) }}">
                                    <i class="fas fa-money-bill-wave" data-toggle="tooltip" data-placement="top"
                                        title="Pagar"></i>
                                </a>
                                <a href="{{ route('contas.outras.destroy', ['id'=>$outras->id]) }}" onclick="return confirm('Deseja excluir o registro ?')">
                                    <i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top"
                                        title="Excluir"></i>
                                </a>
                                <a href="{{ route('contas.outras.edit', ['id'=>$outras->id]) }}">
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
                    {!! $outrasContas->links() !!}
                </nav>
                <a href="{{route('contas.outras.create') }}" class="btn btn-success button-right btn-new">Novo</a>
            </div>
        </div>
    </div>
</div>
@endsection
