@extends('menu')
@section('title', 'Outras contas')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title table-title">Outras contas</h5>
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
                            @foreach ($outrasContas as $outra)
                            <tr>
                                <th scope="row">{{$outra->id}}</th>
                                <td>{{date('d/m/Y', strtotime($outra->dt_emissao))}}</td>
                                <td>{{date('d/m/Y', strtotime($outra->dt_vencimento))}}</td>
                                <td>{{$outra->status == 'A' ? 'Pendente' : 'Pago'}}</td>
                                <td>{{$outra->valor_documento}}</td>
                                <td>{{$outra->juros}}</td>
                                <td>{{$outra->multa}}</td>
                                <td>{{$outra->juros + $outra->valor_documento + $outra->multa}}</td>
                                @if($outra->dt_pagamento != null || $outra->dt_pagamento != '')
                                <td>{{date('d/m/Y', strtotime($outra->dt_pagamento))}}</td>
                                @else
                                <td style="text-align:center">-</td>
                                @endif
                                <td class="action-icons">
                                    @if($outra->status == 'A')
                                        @if(Auth::user()->tipo_usuario == 'G')
                                            <a
                                                href="{{ route('contas.pagar', ['id'=>$outra->id, 'redirect'=>'contas.outras.index']) }}">
                                                <i class="fas fa-money-bill-wave" data-toggle="tooltip" data-placement="top"
                                                    title="Pagar"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('contas.outras.destroy', ['id'=>$outra->id]) }}"
                                            onclick="return confirm('Deseja excluir o registro ?')">
                                            <i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top"
                                                title="Excluir"></i>
                                        </a>
                                        <a href="{{ route('contas.outras.edit', ['id'=>$outra->id]) }}">
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
                    {!! $outrasContas->links() !!}
                </nav>
                <a href="{{route('contas.outras.create') }}" class="btn btn-success button-right btn-new">Novo</a>
            </div>
        </div>
    </div>
</div>
@endsection
