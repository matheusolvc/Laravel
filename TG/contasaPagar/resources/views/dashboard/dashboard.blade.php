@extends('menu')
@section('title', 'Dashboard')
@section('body-content')
<div class="row">
    <div class="col-sm-6 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title">Contas</h5>
                <p class="card-text text-danger">
                    Total de contas vencidas : {{ $qtde_vencidas }}
                </p>
                <a href="{{ route('contas.boletos.index') }}" class="btn btn-primary">Visualizar</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title">Reembolsos</h5>
                <p class="card-text">
                    Total de reembolsos pendentes: {{ $qtde_reembolso }}
                </p>
                <a href="{{ route('reembolso.index') }}" class="btn btn-primary">Visualizar</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title">Contas Pagas</h5>
                {!! $chartjs->render() !!}
            </div>
        </div>
    </div>
</div>
@endsection
