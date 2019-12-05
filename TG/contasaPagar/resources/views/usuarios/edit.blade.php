@extends('menu')
@section('title', 'Boletos')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title">Editar Usuário</h5>
                {!! Form::model($usuario, ['route'=>['usuarios.update', $usuario->id], 'method'=>'put',
                'enctype'=> 'multipart/form-data']) !!}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            {!! Form::label('ID', 'Nº') !!}
                            {!! Form::text('id', null, ['id' => 'id', 'class' => 'form-control', 'placeholder' => '0000', 'disabled' => true]) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('name', 'Nome') !!}
                            {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Nome']) !!}
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-12">Tipo Usuário</label>
                            <div class="form-check form-check-inline">
                                {!! Form::radio('tipo_usuario', 'G', ['id' => 'gerente', 'class'=> 'form-check-input',  ]) !!}
                                {!! Form::label('gerente', 'Gerente') !!}
                            </div>
                            <div class="form-check form-check-inline">
                                {!! Form::radio('tipo_usuario',  'A', ['id' => 'assitente', 'class'=> 'form-check-input',  ]) !!}
                                {!! Form::label('assitente', 'Assistente') !!}
                            </div>
                            <div class="form-check form-check-inline">
                                {!! Form::radio('tipo_usuario', 'C', ['id' => 'colaborador', 'class'=> 'form-check-input',  ]) !!}
                                {!! Form::label('colaborador', 'Colaborador') !!}
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('matricula', 'Matrícula') !!}
                            {!! Form::text('matricula', null, ['id' => 'matricula', 'class' => 'form-control', 'placeholder' => '0000']) !!}
                        </div>
                        <div class="form-group col-md-12">
                            {!! Form::label('email', 'E-mail') !!}
                            {!! Form::email('email', null, ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'E-mail']) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('password', 'Senha') !!}
                            {!! Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Senha']) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('confirm_password', 'Confirmar Senha') !!}
                            {!! Form::password('confirm_password', ['id' => 'confirm_password', 'class' => 'form-control', 'placeholder' => 'Senha']) !!}
                        </div>
                    </div>
                    <a class="btn btn-link" href="{{ route('usuarios.index') }}">Voltar</a>
                    <button type="submit" class="btn btn-primary" style="float:right">Salvar</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
