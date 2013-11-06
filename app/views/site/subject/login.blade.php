@extends('site.layouts.generic')

@section('content')
    {{ Form::open(array('url'=>URL::to('subject/login'), 'method'=>'post')) }}
    {{ Form::label('user_name', 'User Name') }}
    {{ Form::text('user_name', '') }}
    {{ Form::label('password', 'Password') }}
    {{ Form::password('password') }}
    {{ Form::submit('login') }}

    {{ Session::get('error', '') }}

    <ul class="errors">
        @foreach($errors->all() as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>

    {{ Form::close() }}
@stop