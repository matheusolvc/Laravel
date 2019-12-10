@extends('menu')
@section('title', 'Notas Fiscais')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title table-title">Editar Nota Fiscal</h5>
                {!! Form::model($notaFiscal, ['route'=>['contas.notas-fiscais.update', $notaFiscal->id], 'method'=>'put',
                'enctype'=> 'multipart/form-data']) !!}
                    @include('contas._form')
                    <a class="btn btn-link" href="{{ route('contas.notas-fiscais.index') }}">Voltar</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
