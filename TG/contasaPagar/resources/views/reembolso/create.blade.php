@extends('menu')
@section('title', 'Solicitações')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title table-title">Solicitações</h5>
                {!! Form::open(['route'=>'reembolso.store', 'method'=>'post', 'enctype'=> 'multipart/form-data'])
                !!}
                    @include('reembolso._form')
                    <a href="{{ route('reembolso.index') }}" class="btn btn-link">Voltar</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
