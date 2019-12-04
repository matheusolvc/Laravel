@extends('menu')
@section('title', 'Pagar Contas')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">

                {{-- TODO - Filtros --}}
                {{-- END TODO --}}

                <h5 class="card-title table-title">Remessa</h5>
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nº</th>
                            <th scope="col">ID Conta</th>
                            <th scope="col">Tipo Doc.</th>
                            <th scope="col">Usuário</th>
                            <th scope="col">Dt. Geração</th>
                            <th scope="col">Dt. Alteração</th>
                            <th scope="col">Dt. Transmissão</th>
                            <th scope="col">Status</th>
                            <th scope="col">Valor a pagar</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>3</td>
                            <td>Boleto</td>
                            <td>Matheus Campos</td>
                            <td>25/11/2019</td>
                            <td>27/11/2019</td>
                            <td>30/11/2019</td>
                            <td>Pago</td>
                            <td>1350</td>
                            <td class="action-icons">
                                <i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top"
                                    title="Excluir"></i>
                                <i class="fas fa-check" data-toggle="tooltip" data-placement="top" title="Aprovar"></i>
                                <i class="fas fa-external-link-alt" data-toggle="tooltip" data-placement="top"
                                    title="Ver mais"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
                {{-- https://www.tutsmake.com/laravel-6-pagination-with-bootstrap-table-example/ --}}
                {{-- https://appdividend.com/2018/02/23/laravel-pagination-example-tutorial/ --}}
                <nav aria-label="pages" class="button-left">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" tabindex="-1">Anterior</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="page-item ">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Próximo</a>
                        </li>
                    </ul>
                </nav>
                <button type="button" class="btn btn-success button-right btn-new">Novo</button>
            </div>
        </div>
    </div>
</div>
@endsection
