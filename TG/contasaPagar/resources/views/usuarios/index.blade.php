@extends('menu')
@section('title', 'Usuários')
@section('body-content')
<div class="row">
    <div class="col-sm-12 div-card">
        <div class="card card-dashboard">
            <div class="card-body">
                <h5 class="card-title table-title">Permissões de Usuários</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nº</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Matrícula</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Incluir Contas</th>
                                <th scope="col">Pagar Contas</th>
                                <th scope="col">Registar Reembolso</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                            <tr>
                                <th scope="row">{{$usuario->id}}</th>
                                <td>{{$usuario->name}}</td>
                                <td>@if($usuario->tipo_usuario == 'G') Gerente @elseif($usuario->tipo_usuario == 'A') Assistente @else Colaborador @endif</td>
                                <td>{{$usuario->matricula}}</td>
                                <td>{{$usuario->email}}</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" disabled {{ $usuario->tipo_usuario == 'G' || $usuario->tipo_usuario == 'A' ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" disabled {{ $usuario->tipo_usuario == 'G' ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" checked disabled>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td class="action-icons">
                                    <a href="{{ route('usuarios.destroy', ['id'=>$usuario->id]) }}" onclick="return confirm('Deseja excluir o registro ?')">
                                        <i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top"
                                            title="Excluir"></i>
                                    </a>
                                    <a href="{{ route('usuarios.edit', ['id'=>$usuario->id]) }}">
                                        <i class="far fa-edit" data-toggle="tooltip" data-placement="top"
                                            title="Editar"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- https://www.tutsmake.com/laravel-6-pagination-with-bootstrap-table-example/ --}}
                {{-- https://appdividend.com/2018/02/23/laravel-pagination-example-tutorial/ --}}
                <nav aria-label="pages" class="button-left">
                    {!! $usuarios->links() !!}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
