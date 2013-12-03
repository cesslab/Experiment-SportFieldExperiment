@extends('site.layouts.login')

@section('content')
<div class="container">

    {{ Form::open(array('url'=>URL::to('subject/login'), 'method'=>'post', 'class'=>'form-signin')) }}
    <h2 class="form-signin-heading">Participant Login</h2>
    {{ Form::label('user_name', 'User Name', ['class'=>'control-label']) }}
    {{ Form::text('user_name', Input::old('user_name'), ['class'=>'form-control', 'placeholder'=>'User Name']) }}
    <span class="error">{{ $errors->first('user_name') }}</span>
    {{ Form::label('password', 'Password', ['class'=>'control-label']) }}
    {{ Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) }}
    <span class="error">{{ $errors->first('password') }}</span>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    {{ Form::close() }}
</div> <!-- /container -->

@stop
