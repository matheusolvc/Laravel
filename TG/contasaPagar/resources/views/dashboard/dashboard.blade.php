@extends('menu')
@section('title', 'Dashboard')
@section('body-content')
<div class="row">
    <div class="col-sm-6 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title">Contas</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title">Reembolsos</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <canvas class="my-4" id="myChart" width="900" height="380"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection
