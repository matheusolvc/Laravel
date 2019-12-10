@extends('menu')
@section('title', 'Reembolso')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title table-title">Visualizar</h5>
                {!! Form::model($reembolso, ['route'=>['reembolso.update', $reembolso->id], 'method'=>'put',
                'enctype'=> 'multipart/form-data']) !!}
                <div class="form-row">
                    <div class="form-group col-md-6">
                        {!! Form::label('dt_recibo', 'Data do recibo') !!}
                        {!! Form::text('dt_recibo', null, ['id' => 'dt_recibo', 'class' => 'form-control', 'placeholder'
                        =>'DD/MM/YYYY', 'disabled']) !!}
                    </div>
                    <div class="form-group col-md-6">
                        {!! Form::label('valor_documento', 'Valor a reembolsar') !!}
                        {!! Form::text('valor_documento', null, ['id' => 'valor_documento', 'class' => 'form-control',
                        'placeholder' => 'R$ 0,00', 'disabled']) !!}
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('anexo', 'Arquivo') !!}
                        {!! Form::file('arquivo', ['id' => 'anexo', 'class' => 'form-control-file']) !!}
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('descricao', 'Descrição') !!}
                        {!! Form::textarea('descricao', null, ['maxlength' => '220','id'=>'descricao',
                        'rows'=>'3',
                        'class'=>'form-control',
                        'placeholder' =>'Texto...', 'disabled']) !!}
                    </div>
                </div>
                <a href="{{ route('reembolso.index') }}">Voltar</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
