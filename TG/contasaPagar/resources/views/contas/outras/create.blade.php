@extends('menu')
@section('title', 'Outras contas')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title">Outras contas</h5>
                {!! Form::open(['route'=>'contas.outras.store', 'method'=>'post', 'enctype'=> 'multipart/form-data'])
                !!}
                    @section('form-complement')
                        <div class="form-group col-md-6">
                            {!! Form::label('fornecedor', 'Fornecedor') !!}
                            {!! Form::select('id_fornecedor', $fornecedores, null, ['id' => 'fornecedor', 'class' => 'form-control', 'placeholder' => 'Selecione o Fornecedor']) !!}
                        </div>
                    @stop
                    @include('contas._form')
                    <a class="btn btn-link" href="{{ route('contas.outras.index') }}">Voltar</a>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
