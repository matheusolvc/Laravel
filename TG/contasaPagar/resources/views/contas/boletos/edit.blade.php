@extends('menu')
@section('title', 'Boletos')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title table-title">Editar Boleto</h5>
                {!! Form::model($boleto, ['route'=>['contas.boletos.update', $boleto->id], 'method'=>'put',
                'enctype'=> 'multipart/form-data']) !!}
                     @section('form-complement')
                        <div class="form-group col-md-6">
                            {!! Form::label('codigo_barras', 'Cód Barras') !!}
                            {!! Form::text('codigo_barras', null, ['id' => 'codigo_barras', 'class' => 'form-control cod_barras', 'placeholder' => 'Código de Barras',
                            'data-url' => URL::to('/contas/boletos/boleto')]) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('fornecedor', 'Fornecedor') !!}
                            {!! Form::select('id_fornecedor', $fornecedores, null, ['id' => 'fornecedor', 'class' => 'form-control', 'placeholder' => 'Selecione o Fornecedor']) !!}
                        </div>
                    @stop
                    @include('contas._form')
                    <a class="btn btn-link" href="{{ route('contas.boletos.index') }}">Voltar</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
