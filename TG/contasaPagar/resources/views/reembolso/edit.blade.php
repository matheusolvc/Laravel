@extends('menu')
@section('title', 'Solicitações')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title table-title">Solicitações</h5>
                {!! Form::model($reembolso, ['route'=>['reembolso.update', $reembolso->id], 'method'=>'put',
                'enctype'=> 'multipart/form-data']) !!}
                @include('reembolso._form')
                <div class="form-group col-md-6">
                <img src="{{asset($reembolso->arquivo)}}">
                </div>
                <button type="submit" class="btn btn-primary" style="float: right">Salvar</button>
                <a href="{{ route('reembolso.index') }}">Voltar</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
