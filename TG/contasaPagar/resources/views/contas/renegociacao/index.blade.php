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
                                    <th scope="col">Nº Conta</th>
                                    <th scope="col">Usuário</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Dt. Solicitação</th>
                                    <th scope="col">Tipo Renegociação</th>
                                    <th scope="col">Parcelas</th>
                                    <th scope="col">Dt. Vencimento</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Observação</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($renegociacoes as $renegociacao)
                                <tr>
                                    <th scope="row">{{$renegociacao->id}}</th>
                                    <th scope="row">{{$renegociacao->id_conta}}</th>
                                    <th scope="row">{{$renegociacao->usuario->name}}</th>
                                    <td>@if($renegociacao->status == 'A') Pendente @elseif($renegociacao->status == 'P') Pago @elseif($renegociacao->status == 'E') Renegociado @endif</td>
                                    <td>{{date('d/m/Y', strtotime($renegociacao->dt_solicitacao))}}</td>
                                    <td>
                                        @if($renegociacao->tipo_renegociacao == 'Q')
                                            Parcelamento
                                        @elseif($renegociacao->tipo_renegociacao == 'V')
                                            Data Vencimento
                                        @elseif($renegociacao->tipo_renegociacao == 'P')
                                            Valor
                                        @endif
                                    </td>
                                    <td>{{$renegociacao->qtde_parcelas}}</td>
                                    <td>{{date('d/m/Y', strtotime($renegociacao->dt_vencimento))}}</td>
                                    <td>{{$renegociacao->valor_novo}}</td>
                                    <td>{{$renegociacao->observacao}}</td>
                                    <td class="action-icons">
                                    @if($renegociacao->status == 'A')
                                        @if(Auth::user()->tipo_usuario == 'G')
                                            <a
                                                href="{{ route('contas.renegociacao.pagar', ['id'=>$renegociacao->id]) }}">
                                                <i class="fas fa-money-bill-wave" data-toggle="tooltip" data-placement="top"
                                                    title="Pagar"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('contas.renegociacao.destroy', ['id'=>$renegociacao->id]) }}"
                                            onclick="return confirm('Deseja excluir o registro ?')">
                                            <i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top"
                                                title="Excluir"></i>
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
                    {!! $renegociacoes->links() !!}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
