<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    @section('title')
    <title>Experiment</title>
    @show

    <!-- Bootstrap core CSS -->
    {{ HTML::style(URL::asset('assets/bootstrap/dist/css/bootstrap.min.css')) }}
    {{ HTML::style(URL::asset('assets/font-awesome/css/font-awesome.min.css')) }}
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700,400italic' rel='stylesheet' type='text/css'>
    {{ HTML::style(URL::asset('assets/dashboard.css')) }}
    @section('css')
    @show
</head>

<body>

<div id="wrapper">

<!-- Sidebar -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{URL::to('researcher/dashboard')}}">Experiment Administration</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            @section('navbar')
            @show
        </ul>

        <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{Auth::user()->user_name}} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="{{URL::to('researcher/login')}}"><i class="fa fa-power-off"></i> Log Out</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">
    @section('error')
    @show

    @yield('content')

</div><!-- /#page-wrapper -->

</div><!-- /#wrapper -->

<!-- JavaScript -->
{{ HTML::script(URL::asset('assets/jquery/jquery.min.js')) }}
{{ HTML::script(URL::asset('assets/bootstrap/dist/js/bootstrap.min.js')) }}
{{ HTML::script(URL::asset('assets/jquery.tablesorter/js/jquery.tablesorter.min.js')) }}
@section('scripts')
@show
</body>
</html>
