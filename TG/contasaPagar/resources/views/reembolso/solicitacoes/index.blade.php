@extends('menu')
@section('title', 'Reembolso')
@section('body-content')
    <div class="row">
        <div class="col-sm-12 div-card">
            <div class="card card-dashboard">
                <div class="card-body">
                    <h5 class="card-title table-title">Solicitações</h5>
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
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reembolsos as $reembolso)
                                <tr>
                                    <th scope="row">{{ $reembolso->id }}</th>
                                    @if(Auth::user()->tipo_usuario != 'C')
                                        <td >{{ $reembolso->usuario->name }}</td>
                                    @endif
                                    <td>{{ $reembolso->Status == 'A' ? 'Pendente' : 'Pago' }}</td>
                                    <td>{{ date('d/m/Y', strtotime($reembolso->dt_criacao)) }}</td>
                                    <td>{{ date('d/m/Y', strtotime($reembolso->dt_recibo)) }}</td>
                                    <td>{{ $reembolso->valor_documento }}</td>
                                    <td class="action-icons">
                                        <a href="{{ route('reembolso.destroy', ['id'=>$reembolso->id]) }}" onclick="return confirm('Deseja excluir o registro ?')">
                                            <i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top"
                                                title="Excluir"></i>
                                        </a>
                                        <a href="{{ route('reembolso.edit', ['id'=>$reembolso->id]) }}">
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
                        {!! $reembolsos->links() !!}
                    </nav>
                    <a href="{{route('reembolso.create') }}" class="btn btn-success button-right btn-new">Novo</a>
                </div>
            </div>
        </div>
    </div>
@endsection
