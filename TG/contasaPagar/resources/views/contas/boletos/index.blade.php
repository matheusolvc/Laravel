@extends('welcome')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title table-title">Boletos</h5>
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nº</th>
                            <th scope="col">Dt. Emissão</th>
                            <th scope="col">Dt. Vencimento</th>
                            <th scope="col">Status</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Juros</th>
                            <th scope="col">Total</th>
                            <th scope="col">Dt. Pagamento</th>
                            <th scope="col">Valor recebido</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>01/11/2019</td>
                            <td>15/11/2019</td>
                            <td>Pendente</td>
                            <td>R$ 123.3</td>
                            <td>0</td>
                            <td>R$ 123.3</td>
                            <td>-</td>
                            <td>0</td>
                            <td class="action-icons">
                                <i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top"
                                    title="Excluir"></i>
                                <i class="far fa-edit" data-toggle="tooltip" data-placement="top" title="Editar"></i>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>01/11/2019</td>
                            <td>15/11/2019</td>
                            <td>Pendente</td>
                            <td>R$ 123.3</td>
                            <td>0</td>
                            <td>R$ 123.3</td>
                            <td>-</td>
                            <td>0</td>
                            <td class="action-icons">
                                <i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top"
                                    title="Excluir"></i>
                                <i class="far fa-edit" data-toggle="tooltip" data-placement="top" title="Editar"></i>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>01/11/2019</td>
                            <td>15/11/2019</td>
                            <td>Pendente</td>
                            <td>R$ 123.3</td>
                            <td>0</td>
                            <td>R$ 123.3</td>
                            <td>-</td>
                            <td>0</td>
                            <td class="action-icons">
                                <i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top"
                                    title="Excluir"></i>
                                <i class="far fa-edit" data-toggle="tooltip" data-placement="top" title="Editar"></i>
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
