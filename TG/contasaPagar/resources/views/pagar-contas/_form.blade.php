<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('ID', 'Cód. Lote') !!}
        {!! Form::text('id', $lote->id, ['id' => 'id', 'class' => 'form-control', 'placeholder' => '0000', 'disabled' => true]) !!}
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('dt_geracao', 'Data Geração') !!}
        {!! Form::text('dt_geracao', date('d/m/Y', strtotime($lote->dt_geracao)), ['id' => 'dt_geracao', 'class' => 'form-control', 'placeholder' => '0000', 'disabled' => true]) !!}
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('dt_alteracao', 'Data Alteração') !!}
        {!! Form::text('dt_alteracao', $lote->alteracao, ['id' => 'dt_alteracao', 'class' => 'form-control', 'placeholder' => 'DD/MM/YYYY', 'disabled' => true]) !!}
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('valor_lote', 'Valor Lote') !!}
        {!! Form::text('valor_lote', $lote->valor_lote, ['id' => 'valor_lote', 'class' => 'form-control', 'placeholder' => '0000', 'disabled' => true]) !!}
    </div>

    <h5 class="card-title table-title col-md-12">Contas adicionadas</h5>
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
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lote_contas as $lote_conta)
            <tr>
                <th scope="row">{{$lote_conta->id}}</th>
                <td>{{$lote_conta->dt_emissao}}</td>
                <td>{{$lote_conta->dt_vencimento}}</td>
                <td>{{$lote_conta->status == 'A' ? 'Pendente' : 'Pago'}}</td>
                <td>{{$lote_conta->valor_documento}}</td>
                <td>{{$lote_conta->juros}}</td>
                <td>{{$lote_conta->multa}}</td>
                <td>{{$lote_conta->juros + $lote_conta->valor_documento + $lote_conta->multa}}</td>
                <td class="action-icons">
                    <a href="{{ route('pagar-conta.destroyConta', ['id'=>$lote->id, 'id_conta'=>$lote_conta->id]) }}">
                        <i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top"
                            title="Excluir"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- https://www.tutsmake.com/laravel-6-pagination-with-bootstrap-table-example/ --}}
    {{-- https://appdividend.com/2018/02/23/laravel-pagination-example-tutorial/ --}}
    <nav aria-label="pages" class="button-left">
        {!! $lote_contas->links() !!}
    </nav>
</div>
