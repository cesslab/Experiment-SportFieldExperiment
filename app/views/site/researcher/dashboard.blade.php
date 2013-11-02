@extends('site.layouts.generic')

@section('content')
    {{ Form::open(array('url'=>URL::to('researcher/dashboard'), 'method'=>'post')) }}
        <fieldset>
            <legend>New Session</legend>
            {{ Form::label('num_subjects', 'Number of Subjects') }}
            {{ Form::text('num_subjects', '') }}
            <fieldset>
                <legend>Willingness To Pay</legend>
                {{ Form::label('endowment', 'Endowment') }}
                {{ Form::text('num_subjects', '') }}
            </fieldset>
            <fieldset>
                <legend>Risk Aversion</legend>
                {{ Form::label('prize[1]', 'Prize A') }}
                {{ Form::text('prize[1]', '') }}
                {{ Form::label('prize[2]', 'Prize B') }}
                {{ Form::text('prize[2]', '') }}
                {{ Form::label('prize[3]', 'Prize C') }}
                {{ Form::text('prize[3]', '') }}
            </fieldset>
            {{ Form::submit('Add New Session') }}
        </fieldset>
    {{ Form::close() }}

<ul class="errors">
    @foreach($errors->all() as $message)
    <li>{{ $message }}</li>
    @endforeach
</ul>

    <table>
        @foreach($sessions as $session)
            <tr>{{ $session->num_subjects }}</tr>
        @endforeach
    </table>
@stop