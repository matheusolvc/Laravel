@extends('menu')
@section('title', 'Solicitações')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title">Solicitações</h5>
                {!! Form::open(['route'=>'reembolso.create', 'method'=>'post', 'enctype'=> 'multipart/form-data'])
                !!}

                @include('reembolso.solicitacoes._form')
                <div class="form-group">
                    <label for="anexo">Anexo</label>
                    <input type="file" class="form-control-file" id="anexo">
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
