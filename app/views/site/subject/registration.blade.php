@extends('site.layouts.generic')

@section('content')
<div>
    {{ Form::open(array('url'=>$postUrl, 'method'=>'post')) }}
    <fieldset>
        <legend>Demographic Information</legend>
        <div>
            {{ Form::label('first_name', 'First Name') }}
            {{ Form::text('first_name', '') }}
        </div>

        <div>
            {{ Form::label('last_name', 'Last Name') }}
            {{ Form::text('last_name', '') }}
        </div>

        <div>
            {{ Form::label('profession', 'Profession') }}
            {{ Form::text('profession', '') }}
        </div>

        <div>
            {{ Form::label('education', 'Education') }}
            {{ Form::text('education', '') }}
        </div>

        <div>
            {{ Form::label('gender', 'Gender') }}
            {{ Form::text('gender', '') }}
        </div>

        <div>
            {{ Form::label('ethnicity', 'Ethnicity') }}
            {{ Form::text('ethnicity', '') }}
        </div>

        <div>
            {{ Form::label('age', 'Age') }}
            {{ Form::text('age', '') }}
        </div>

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
