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

<div id="container">

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
            <a class="navbar-brand" href="{{URL::to('researcher/dashboard')}}"></a>
        </div>
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
