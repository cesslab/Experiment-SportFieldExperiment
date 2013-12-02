@extends('site.layouts.login')

@section('content')
<div class="container">

    {{ Form::open(array('url'=>URL::to('subject/login'), 'method'=>'post', 'class'=>'form-signin')) }}
    <h2 class="form-signin-heading">Participant Login</h2>
    {{ Form::label('user_name', 'User Name', ['class'=>'control-label']) }}
    {{ Form::text('user_name', Input::old('user_name'), ['class'=>'form-control', 'placeholder'=>'User Name']) }}
    {{ Form::label('password', 'Password', ['class'=>'control-label']) }}
    {{ Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) }}
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    {{ Form::close() }}

    <ul class="errors">
        @foreach($errors->all() as $message)
        <li>{{ $message }}</li>
        @endforeach
        {{ Session::get('error', '') }}
    </ul>
</div> <!-- /container -->

@stop
