@extends('menu')
@section('title', 'Boletos')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title">Boletos</h5>
                {!! Form::model($contas, ['route'=>['contas.boletos.update', $conta->id], 'method'=>'put',
                'enctype'=> 'multipart/form-data']) !!}
                @include('contas.boletos._form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
