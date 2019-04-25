<!DOCTYPE html>
<html lang="en">
    <head>
        <title>SETA - Sistema de Entrega de Trabalhos e Atividades</title>

        <!-- Latest compiled and minified CSS -->

        <!-- Bootstrap URL - CSS -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Custom styles for this template -->
        <link href="{{ url('/themes/theme.css') }}" rel="stylesheet">
        <!-- Ajax Script -->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        @yield('script')

    </head>

    <body role="document">
        <!-- Fixed navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand">SETA - Sistema de Entrega de Trabalhos e Atividades</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active">
                                <a href="{{ url('/') }}">
                                    Home
                                </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container theme-showcase" role="main">

            <div class="page-header">

                <div class="page-header">
                    <h1 class="form-signin-heading">
                        @yield('cabecalho')
                    </h1>
                </div>

                @yield('conteudo')

            </div>

            <div class="page-header">
                <b>&copy;2018
                    &nbsp;&nbsp;&raquo;&nbsp;&nbsp;
                    Gil Eduardo de Andrade
                    &nbsp;&nbsp;&raquo;&nbsp;&nbsp;
                    versão 3.0
                </b>
            </div>
    </body>
</html>
