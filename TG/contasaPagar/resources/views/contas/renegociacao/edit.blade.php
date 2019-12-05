@extends('menu')
@section('title', 'Renegociação')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title">Renegociação</h5>
                {!! Form::model($renegociacao, ['route'=>['contas.renegociacoes.update', $renegociacao->id],
                'method'=>'put',
                'enctype'=> 'multipart/form-data']) !!}

                @include('contas.renegociacao._form')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
