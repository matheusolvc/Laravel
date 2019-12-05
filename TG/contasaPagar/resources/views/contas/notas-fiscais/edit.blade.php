@extends('menu')
@section('title', 'Boletos')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title table-title">Editar Nota Fiscal</h5>
                {!! Form::model($notaFiscal, ['route'=>['contas.notas-fiscais.update', $notaFiscal->id], 'method'=>'put',
                'enctype'=> 'multipart/form-data']) !!}
                <div class="form-row">
                        <div class="form-group col-md-4">
                            {!! Form::label('ID', 'Cód. Nota Fiscal') !!}
                            {!! Form::text('id', null, ['id' => 'id', 'class' => 'form-control', 'placeholder' => '0000', 'disabled' => true]) !!}
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('num_doc', 'Numero Doc.') !!}
                            {!! Form::text('num_doc', null, ['id' => 'num_doc', 'class' => 'form-control', 'placeholder' => '0000-0']) !!}
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('serie', 'Série') !!}
                            {!! Form::text('serie', null, ['id' => 'serie', 'class' => 'form-control', 'placeholder' => 'Numero de Série', 'disabled' => true]) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('dt_emissao', 'Data do Documento') !!}
                            {!! Form::text('dt_emissao', null, ['id' => 'dt_emissao', 'class' => 'form-control', 'placeholder' => 'DD/MM/YYYY']) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('dt_vencimento', 'Vencimento') !!}
                            {!! Form::text('dt_vencimento', null, ['id' => 'dt_vencimento', 'class' => 'form-control', 'placeholder' => 'DD/MM/YYYY']) !!}
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('valor_documento', 'valor do Documento') !!}
                            {!! Form::text('valor_documento', null, ['id' => 'valor_documento', 'class' => 'form-control', 'placeholder' => 'R$ 0,00']) !!}
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('multa', 'Valor da Multa') !!}
                            {!! Form::text('multa', null, ['id' => 'multa', 'class' => 'form-control', 'placeholder' => 'R$ 0,00']) !!}
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('juros', 'Valor do Juros') !!}
                            {!! Form::text('juros', null, ['id' => 'multa', 'class' => 'form-control', 'placeholder' => 'R$ 0,00']) !!}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="float:right">Salvar</button>
                    <a class="btn btn-link" href="{{ route('contas.notas-fiscais.index') }}">Voltar</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
