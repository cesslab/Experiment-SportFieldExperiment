<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    @section('title')
    <title>Experiment</title>
    @show

    <!-- Bootstrap core CSS -->
    {{ HTML::style(URL::asset('assets/bootstrap/dist/css/bootstrap.min.css')) }}
    {{ HTML::style(URL::asset('assets/login.css')) }}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <!-- Navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                Researcher Dashboard</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @section('navbar')
                @show
            </ul>
        </div><!--/.nav-collapse -->
        </div>
    </div>

    <div class = "container">
        @yield('content')
    </div>

<!-- Scripts -->
{{ HTML::script(URL::asset('assets/jquery/jquery.min.js')) }}
{{ HTML::script(URL::asset('assets/bootstrap/dist/js/bootstrap.min.js')) }}
</body>
</html>
