@extends('menu')
@section('title', 'Pagar Contas')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">

                {{-- TODO - Filtros --}}
                {{-- END TODO --}}

                <h5 class="card-title table-title">Remessas pendentes</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nº</th>
                                <th scope="col">Data Geração</th>
                                <th scope="col">Data Alteração</th>
                                <th scope="col">Usuário</th>
                                <th scope="col">Status</th>
                                <th scope="col">valor Lote</th>
                                <th scope="col">Data Transmissão</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($lotes as $lote)
                                <th scope="row">{{ $lote->id }}</th>
                                <td>{{ date('d/m/Y', strtotime($lote->dt_geracao)) }}</td>
                                <td>{{ $lote->dt_alteracao == null ? '-' : date('d/m/Y', strtotime($lote->dt_alteracao)) }}
                                </td>
                                <td>{{ $lote->usuario->name }}</td>
                                <td>{{ $lote->status == 'E' ? 'Em processamento' : $lote->status == 'A' ? 'Pendente' : 'Finalizado'  }}
                                </td>
                                <td>{{ $lote->valor_lote }}</td>
                                <td>{{ $lote->dt_transmissao == null ? '-' : date('d/m/Y', strtotime($lote->dt_transmissao)) }}
                                </td>
                                <td class="action-icons">
                                    <a href="{{ route('pagar-conta.processar', ['id'=>$lote->id]) }}">
                                        <i class="fas fa-check" data-toggle="tooltip" data-placement="top"
                                            title="Processar"></i>
                                    </a>
                                    <a href="{{ route('pagar-conta.destroy', ['id'=>$lote->id]) }}"
                                        onclick="return confirm('Deseja excluir o registro ?')">
                                        <i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top"
                                            title="Excluir"></i>
                                    </a>
                                    <a href="{{ route('pagar-conta.edit', ['id'=>$lote->id]) }}">
                                        <i class="far fa-edit" data-toggle="tooltip" data-placement="top"
                                            title="Editar"></i>
                                    </a>
                                </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{-- https://www.tutsmake.com/laravel-6-pagination-with-bootstrap-table-example/ --}}
                {{-- https://appdividend.com/2018/02/23/laravel-pagination-example-tutorial/ --}}
                <nav aria-label="pages" class="button-left">
                    {!! $lotes->links() !!}
                </nav>
                <a href="{{route('pagar-conta.create') }}" class="btn btn-success button-right btn-new">Novo</a>
            </div>

        </div>
    </div>
    <!-- CARD REMESSA PROCESSADAS -->
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title table-title">Retorno Remessas</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nº</th>
                                <th scope="col">Data Geração</th>
                                <th scope="col">Data Alteração</th>
                                <th scope="col">Usuário</th>
                                <th scope="col">valor Lote</th>
                                <th scope="col">Data Transmissão</th>
                                <th scope="col">Status</th>
                                <th scope="col">Mensagem</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($retorno_lotes as $retorno_lote)
                                <th scope="row">{{ $retorno_lote->lote->id }}</th>
                                <td>{{ date('d/m/Y', strtotime($retorno_lote->lote->dt_geracao)) }}</td>
                                <td>{{ $retorno_lote->lote->dt_alteracao == null ? '-' : date('d/m/Y', strtotime($retorno_lote->lote->dt_alteracao)) }}
                                </td>
                                <td>{{ $retorno_lote->lote->usuario->name }}</td>
                                <td>{{ $retorno_lote->lote->valor_lote }}</td>
                                <td>{{ $retorno_lote->lote->dt_transmissao == null ? '-' : date('d/m/Y', strtotime($retorno_lote->lote->dt_transmissao)) }}
                                </td>
                                <td>{{ $retorno_lote->status == 'S' ? 'Processada com sucesso' : 'Falha no processamento' }}
                                </td>
                                <td>{{ $retorno_lote->mensagem  }}</td>
                                <td class="action-icons">
                                    @if($retorno_lote->status == 'F')
                                    <a href="{{ route('pagar-conta.processar', ['id'=>$retorno_lote->lote->id]) }}">
                                        <i class="fas fa-sync" data-toggle="tooltip" data-placement="top"
                                            title="Reenviar"></i>
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
                    {!! $retorno_lotes->links() !!}
                </nav>
            </div>

        </div>
    </div>
</div>
@endsection
