@extends('menu')
@section('title', 'Pagar Contas')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title table-title">Gerar Remessa</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Sel.</th>
                                <th scope="col">Nº</th>
                                <th scope="col">Dt. Emissão</th>
                                <th scope="col">Dt. Vencimento</th>
                                <th scope="col">Status</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Juros</th>
                                <th scope="col">Multa</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contas as $conta)
                            <tr>
                                <th scope="row">
                                    <input type="checkbox" class="chk" value="{{ $conta->id }}">
                                </th>
                                <th scope="row">{{$conta->id}}</th>
                                <td>{{$conta->dt_emissao}}</td>
                                <td>{{$conta->dt_vencimento}}</td>
                                <td>{{$conta->status == 'A' ? 'Pendente' : 'Pago'}}</td>
                                <td>{{$conta->valor_documento}}</td>
                                <td>{{$conta->juros}}</td>
                                <td>{{$conta->multa}}</td>
                                <td>{{$conta->juros + $conta->valor_documento + $conta->multa}}</td>
                                @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- https://www.tutsmake.com/laravel-6-pagination-with-bootstrap-table-example/ --}}
                {{-- https://appdividend.com/2018/02/23/laravel-pagination-example-tutorial/ --}}
                <nav class="col-md-12" aria-label="pages" class="button-left">
                    {!! $contas->links() !!}
                </nav>

                <div class="col-md-12">
                    {!! Form::open(['route'=>'pagar-conta.store', 'method'=>'post', 'enctype'=> 'multipart/form-data'])
                    !!}
                    {!! Form::hidden('id_contas', 'id[]', ['id' => 'id_contas']) !!}
                    <a href="{{ route('pagar-conta.index') }}" class="btn btn-link">Voltar</a>
                    <button type="submit" style="float:right" class="btn btn-primary check">Gerar</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
