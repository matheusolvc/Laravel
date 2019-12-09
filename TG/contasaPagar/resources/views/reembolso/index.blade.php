@extends('menu')
@section('title', 'Reembolso')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title table-title">Reembolsos</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nº</th>
                                @if(Auth::user()->tipo_usuario != 'C')
                                    <th scope="col">Usuário</th>
                                @endif
                                <th scope="col">Status</th>
                                <th scope="col">Dt. Solicitação</th>
                                <th scope="col">Dt. Recibo</th>
                                <th scope="col">Valor a pagar</th>
                                @if(Auth::user()->tipo_usuario != 'C')
                                    <th scope="col">Visualizar</th>
                                @endif
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reembolsos as $reembolso)
                                <tr>
                                    <th scope="row">{{ $reembolso->id }}</th>
                                    @if(Auth::user()->tipo_usuario != 'C')
                                        <td>{{ $reembolso->colaborador->nome }}</td>
                                    @endif
                                    <td>
                                        @if($reembolso->status == 'A')
                                            Pendente
                                        @elseif($reembolso->status == 'P')
                                            Pago
                                        @else
                                            Recusado
                                        @endif
                                    </td>
                                    <td>{{ date('d/m/Y', strtotime($reembolso->dt_criacao)) }}</td>
                                    <td>{{ date('d/m/Y', strtotime($reembolso->dt_recibo)) }}</td>
                                    <td>{{ $reembolso->valor_documento }}</td>
                                    @if(Auth::user()->tipo_usuario != 'C')
                                    <td>
                                        <a
                                        href="{{ route('contas.pagar', ['id'=>$reembolso->id, 'redirect'=>'reembolso.show']) }}">
                                            <i class="fas fa-eye" data-toggle="tooltip" data-placement="top"
                                            title="Visualizar"></i>
                                        </a>
                                    </td>
                                    @endif
                                    <td class="action-icons">
                                        @if(Auth::user()->tipo_usuario == 'G')
                                            @if($reembolso->status == 'A')
                                                <a
                                                    href="{{ route('contas.pagar', ['id'=>$reembolso->id, 'redirect'=>'reembolso.index']) }}">
                                                    <i class="fas fa-money-bill-wave" data-toggle="tooltip" data-placement="top"
                                                        title="Pagar"></i>
                                                </a>

                                                <a
                                                    href="{{ route('reembolso.recusar', ['id'=>$reembolso->id, 'redirect'=>'reembolso.index']) }}">
                                                    <i class="fas fa-ban" data-toggle="tooltip" data-placement="top"
                                                        title="Pagar"></i>
                                                </a>
                                            @endif
                                        @endif
                                        @if(Auth::user()->tipo_usuario == 'C')
                                            @if($reembolso->status == 'A')
                                            <a href="{{ route('reembolso.destroy', ['id'=>$reembolso->id]) }}"
                                                onclick="return confirm('Deseja excluir o registro ?')">
                                                <i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top"
                                                    title="Excluir"></i>
                                            </a>
                                            <a href="{{ route('reembolso.edit', ['id'=>$reembolso->id]) }}">
                                                <i class="far fa-edit" data-toggle="tooltip" data-placement="top"
                                                    title="Editar"></i>
                                            </a>
                                            @endif
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
                    {!! $reembolsos->links() !!}
                </nav>
                @if(Auth::user()->tipo_usuario == 'C')
                    <a href="{{route('reembolso.create') }}" class="btn btn-success button-right btn-new">Novo</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
