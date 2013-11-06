@extends('site.layouts.generic')

@section('content')
    <a href="{{ $dashboardUrl }}">Dashboard</a>
<div>
    {{ Form::open(array('url'=>$postUrl, 'method'=>'post')) }}
        <fieldset>
            <legend>New Session</legend>
            {{ Form::label($numSubjectsKey, 'Number of Subjects') }}
            {{ Form::text($numSubjectsKey, Input::old($numSubjectsKey)) }}
            <fieldset>
                <legend>Willingness To Pay</legend>
                {{ Form::label($endowmentKey, 'Endowment') }}
                {{ Form::text($endowmentKey, Input::old($endowmentKey)) }}
            </fieldset>
            <fieldset>
                <legend>Risk Aversion</legend>
                {{ Form::label($lowPrizeKey, 'Low Prize') }}
                {{ Form::text($lowPrizeKey, Input::old($lowPrizeKey)) }}

                {{ Form::label($midPrizeKey, 'Mid Prize') }}
                {{ Form::text($midPrizeKey, Input::old($midPrizeKey)) }}

                {{ Form::label($highPrizeKey, 'High Prize') }}
                {{ Form::text($highPrizeKey, Input::old($highPrizeKey)) }}

                {{ Form::label($gambleProbKey, 'Gamble Probability') }}
                {{ Form::text($gambleProbKey, Input::old($gambleProbKey)) }}
            </fieldset>
            {{ Form::submit('Add New Session') }}
        </fieldset>
    {{ Form::close() }}

    <ul class="errors">
        @foreach($errors->all() as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>
</div>
@stop