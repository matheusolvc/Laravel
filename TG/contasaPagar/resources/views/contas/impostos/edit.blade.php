@extends('menu')
@section('title', 'Impostos')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title">Editar Imposto</h5>
                {!! Form::model($imposto, ['route'=>['contas.impostos.update', $imposto->id], 'method'=>'put',
                'enctype'=> 'multipart/form-data']) !!}
                      @section('form-complement')
                      <div class="form-group col-md-6">
                          {!! Form::label('cod_imposto', 'Cod. Imposto') !!}
                          {!! Form::text('cod_imposto', null, ['id' => 'cod_imposto', 'class' => 'form-control', 'placeholder' => 'Código do imposto']) !!}
                      </div>
                      <div class="form-group col-md-6">
                          {!! Form::label('codigo_barras', 'Cod. Barras') !!}
                          {!! Form::text('codigo_barras', null, ['id' => 'codigo_barras', 'class' => 'form-control cod_barras', 'placeholder' => 'Código de Barras']) !!}
                      </div>
                      <div class="form-group col-md-6">
                          {!! Form::label('periodo_apuracao', 'Período de apuração') !!}
                          {!! Form::text('dt_vencimento', null, ['id' => 'dt_vencimento', 'class' => 'form-control date', 'placeholder' => 'DD/MM/YYYY']) !!}
                      </div>
                      <div class="form-group col-md-6">
                          {!! Form::label('cnpj_matriz', 'CNPJ Matriz') !!}
                          {!! Form::text('cnpj_matriz', null, ['id' => 'cnpj_matriz', 'class' => 'form-control cnpj', 'placeholder' => 'CNPJ']) !!}
                      </div>
                  @stop
                    @include('contas._form')
                    <a class="btn btn-link" href="{{ route('contas.impostos.index') }}">Voltar</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
