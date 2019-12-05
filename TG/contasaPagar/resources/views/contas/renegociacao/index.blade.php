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
                                <th scope="col">Status</th>
                                <th scope="col">Dt. Solicitação</th>
                                <th scope="col">Tipo renegociação</th>
                                <th scope="col">Qtde. Parcelas</th>
                                <th scope="col">Dt. Vencimento</th>
                                <th scope="col">Valor novo</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($renegociacao as $ren)
                            <tr>
                                <th scope="row">{{ $ren->id }}</th>
                                <td>{{$ren->status}}</td>
                                <td>{{ date('d/m/Y', strtotime($ren->dt_solicitacao)) }}</td>
                                <td>{{$ren->tipo_renegociacao}}</td>
                                <td>{{$ren->qtde_parcelas}}</td>
                                <td>{{ date('d/m/Y', strtotime($ren->dt_vencimento)) }}</td>
                                <td>{{$ren->valor_novo}}</td>
                                <td class="action-icons">
                                    <a
                                        href="{{ route('contas.pagar', ['id'=>$ren->id, 'redirect'=>'contas.ren.index']) }}">
                                        <i class="fas fa-money-bill-wave" data-toggle="tooltip" data-placement="top"
                                            title="Pagar"></i>
                                    </a>
                                    <a href="{{ route('contas.ren.destroy', ['id'=>$ren->id]) }}"
                                        onclick="return confirm('Deseja excluir o registro ?')">
                                        <i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top"
                                            title="Excluir"></i>
                                    </a>
                                    <a href="{{ route('contas.ren.edit', ['id'=>$ren->id]) }}">
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
                    {!! $renegociacao->links() !!}
                </nav>
                @if(Auth::user()->tipo_usuario == 'C')
                <a href="{{route('ren.create') }}" class="btn btn-success button-right btn-new">Novo</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
