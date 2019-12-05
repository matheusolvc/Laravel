@extends('menu')
@section('title', 'Notas Fiscais')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title">NFs Migradas</h5>
                {!! Form::open(['route'=>'contas.boletos.store', 'method'=>'post', 'enctype'=> 'multipart/form-data'])
                !!}
                    @section('form-complement')
                        <div class="form-group col-md-6">
                            {!! Form::label('codigo_barras', 'Cód Barras') !!}
                            {!! Form::text('codigo_barras', null, ['id' => 'codigo_barras', 'class' => 'form-control', 'placeholder' => 'Código de Barras']) !!}
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
