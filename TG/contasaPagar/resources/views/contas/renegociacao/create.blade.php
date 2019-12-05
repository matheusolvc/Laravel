@extends('menu')
@section('title', 'Renegociação')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title">Renegociação</h5>
                {!! Form::model($renegociacao, ['route'=>'contas.renegociacao.store', 'method'=>'post', 'enctype'=> 'multipart/form-data'])
                !!}

                @include('contas.renegociacao._form')
                <a href="{{ route('contas.renegociacao.index') }}" class="btn btn-link">Voltar</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
