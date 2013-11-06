@extends('site.layouts.generic')

@section('content')
<div>
    {{ Form::open(array('url'=>$postUrl, 'method'=>'post')) }}
    <fieldset>
        <legend>Demographic Information</legend>
        {{ Form::label('first_name', 'First Name') }}
        {{ Form::text('first_name', '') }}

        {{ Form::label('last_name', 'Last Name') }}
        {{ Form::text('last_name', '') }}

        {{ Form::label('profession', 'Profession') }}
        {{ Form::text('profession', '') }}

        {{ Form::label('education', 'Education') }}
        {{ Form::text('education', '') }}

        {{ Form::label('gender', 'Gender') }}
        {{ Form::text('gender', '') }}

        {{ Form::label('ethnicity', 'Ethnicity') }}
        {{ Form::text('ethnicity', '') }}

        {{ Form::label('age', 'Age') }}
        {{ Form::text('age', '') }}

        {{ Form::submit('Submit Demographic Info') }}
    </fieldset>
    {{ Form::close() }}

    <ul class="errors">
        @foreach($errors->all() as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>
</div>
@stop
