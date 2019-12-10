@extends('menu')
@section('title', 'Boletos')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title table-title">Relátorios</h5>
                {!! Form::open(['route'=>'relatorios.gerar', 'method'=>'post', 'enctype'=> 'multipart/form-data'])
                !!}
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            {!! Form::label('data_de', 'Data de ') !!}
                            {!! Form::select('data_de', ['dt_vencimento' => 'Vencimento', 'dt_emissao' => 'Emissão'], null, ['id' => 'data_de', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-md-3">
                            {!! Form::label('dt_inicial', 'Data Inicial') !!}
                            {!! Form::text('dt_inicial', null, ['id' => 'dt_inicial', 'class' => 'form-control date', 'placeholder' => 'DD/MM/YYYY',]) !!}
                        </div>
                        <div class="form-group col-md-3">
                            {!! Form::label('dt_final', 'Data Final') !!}
                            {!! Form::text('dt_final', null, ['id' => 'dt_final', 'class' => 'form-control date', 'placeholder' => 'DD/MM/YYYY',]) !!}
                        </div>
                        <div class="form-group col-md-3">
                            {!! Form::label('tipo_conta', 'Tipo da Conta') !!}
                            {!! Form::select('tipo_conta', ['B' => 'Boleto', 'I' => 'Imposto', 'N' => 'Nota Fiscal', 'T' => 'Reembolso', 'O' => 'Outras'], null, ['id' => 'fornecedor', 'class' => 'form-control', 'placeholder' => 'Todas']) !!}
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('fornecedor', 'Fornecedor') !!}
                            {!! Form::select('id_fornecedor', $fornecedores, null, ['id' => 'fornecedor', 'class' => 'form-control', 'placeholder' => 'Todos']) !!}
                        </div>
                        @error('juros')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary" style="float:right">
                        Gerar
                    </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
