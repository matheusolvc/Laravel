<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>{{ config('app.name', 'Laravel') }}</h3>
            </div>
            <div class="div-user">
                <i class="fas fa-user"></i>
                <p class="user-name">{{ Auth::user()->name }}</p>
            </div>
            <ul class="list-unstyled components">

                @if(Auth::user()->tipo_usuario != 'C')
                <li class="active side-link">
                    <a href="/">Dashboard</a>
                </li>
                <li>
                    <a href="#contaSubmenu" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">Contas</a>
                    <ul class="collapse list-unstyled" id="contaSubmenu">
                        <li class="side-link">
                            <a href="{{ URL::to('/contas/boletos') }}">Boletos</a>
                        </li>
                        <li class="side-link">
                            <a href="{{ URL::to('contas/impostos') }}">Impostos</a>
                        </li>
                        <li class="side-link">
                            <a href="{{ URL::to('contas/notas-fiscais') }}">Notas Fiscais</a>
                        </li>
                                                <li class="side-link">
                                                    <a href="{{ URL::to('contas/outras') }}">Outras</a>
                                                </li>
                    </ul>
                </li>
                <li class="side-link">
                    <a href="{{ route('pagar-conta.index') }}">Remessas</a>
                </li>
                <li class="side-link">
                        <a href="{{ route('contas.renegociacao.index') }}">Renegociações</a>
                    </li>
                @endif
                <li class="side-link">
                    <a href="{{ URL::to('/reembolso') }}">Reembolsos</a>
                </li>

                @if(Auth::user()->tipo_usuario != 'C')
                    <li class="side-link">
                        <a href="{{ url('/usuarios') }}">Usuários</a>
                    </li>
                    <li class="side-link">
                        <a href="{{ url('/usuarios') }}">Relatórios</a>
                    </li>
                @endif
            </ul>

            <ul class="list-unstyled CTAs">

            </ul>
        </nav>
        <nav id="nav-top" class="purple navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn-custom">
                    <i class="fas fa-bars whitesmoke"></i>
                </button>

                <p class="text-center text-success">Saldo : {{$saldo}}</p>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    @if (Route::has('login'))
                    <ul class="nav navbar-nav ml-auto">
                        @auth
                        <li class="nav-item active">

                            <a class="nav-link" href="{{ url('/logout') }}">Sair</a>
                            @else
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">Registrar</a>
                            @endif
                        </li>
                        @endauth
                    </ul>
                    @endif
                </div>
            </div>
        </nav>
        <!-- Page Content  -->
        <div id="content">
            @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @yield('body-content')

        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>

    <script src="{{ asset('js/custom.js') }}" type="text/javascript"></script>

</body>

</html>
