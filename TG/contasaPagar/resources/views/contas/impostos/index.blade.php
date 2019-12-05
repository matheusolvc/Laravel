@extends('menu')
@section('title', 'Impostos')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title table-title">Impostos</h5>
                <div class="table-responsive">
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
                        @foreach ($impostos as $imposto)
                        <tr>
                            <th scope="row">
                                <input type="checkbox" class="chk">
                            </th>
                            <th scope="row">{{$imposto->id}}</th>
                            <td>{{$imposto->dt_emissao}}</td>
                            <td>{{$imposto->dt_vencimento}}</td>
                            <td>{{$imposto->status == 'A' ? 'À Pagar' : 'Pago'}}</td>
                            <td>{{$imposto->valor_documento}}</td>
                            <td>{{$imposto->juros}}</td>
                            <td>{{$imposto->multa}}</td>
                            <td>{{$imposto->juros + $imposto->valor_documento + $imposto->multa}}</td>
                            @if($imposto->dt_pagamento != null || $imposto->dt_pagamento != '')
                            <td>{{$imposto->dt_pagamento}}</td>
                            @else
                            <td style="text-align:center">-</td>
                            @endif
                            <td class="action-icons">

                                <a href="{{ route('contas.pagar', ['id'=>$imposto->id, 'redirect'=>'contas.impostos.index']) }}">
                                    <i class="fas fa-money-bill-wave" data-toggle="tooltip" data-placement="top"
                                        title="Pagar"></i>
                                </a>
                                <a href="{{ route('contas.impostos.destroy', ['id'=>$imposto->id]) }}" onclick="return confirm('Deseja excluir o registro ?')">
                                    <i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top"
                                        title="Excluir"></i>
                                </a>
                                <a href="{{ route('contas.impostos.edit', ['id'=>$imposto->id]) }}">
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
                    {!! $impostos->links() !!}
                </nav>
                <a href="{{route('contas.impostos.create') }}" class="btn btn-success button-right btn-new">Novo</a>
            </div>
        </div>
    </div>
</div>
@endsection
