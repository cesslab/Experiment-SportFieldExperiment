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
                <legend>Task {{$riskAversionTaskId}}: Risk Aversion</legend>
                <div>
                    {{ Form::label($lowPrizeKey, 'Low Prize') }}
                    {{ Form::text($lowPrizeKey, Input::old($lowPrizeKey)) }}
                </div>

                <div>
                    {{ Form::label($midPrizeKey, 'Mid Prize') }}
                    {{ Form::text($midPrizeKey, Input::old($midPrizeKey)) }}
                </div>

                <div>
                    {{ Form::label($highPrizeKey, 'High Prize') }}
                    {{ Form::text($highPrizeKey, Input::old($highPrizeKey)) }}
                </div>

                <div>
                    {{ Form::label($gambleProbKey, 'Gamble Probability') }}
                    {{ Form::text($gambleProbKey, Input::old($gambleProbKey)) }}
                </div>
            </fieldset>
            <fieldset>
                <legend>Task {{$willingnessPayTaskId}}: Willingness To Pay</legend>
                {{ Form::label($endowmentKey, 'Endowment') }}
                {{ Form::text($endowmentKey, Input::old($endowmentKey)) }}
            </fieldset>
            <fieldset>
                <legend>Task {{$ultimatumTaskId}}: Ultimatum</legend>
                <div>
                    {{ Form::label($ultimatumTotalAmountKey, 'Total Amount') }}
                    {{ Form::text($ultimatumTotalAmountKey, Input::old($ultimatumTotalAmountKey)) }}
                </div>
            </fieldset>
            <fieldset>
                <legend>Task {{$trustTaskId}}: Trust</legend>
                <div>
                    {{ Form::label($trustSenderMultiplierKey, 'Sender Multiplier') }}
                    {{ Form::text($trustSenderMultiplierKey, Input::old($trustSenderMultiplierKey)) }}
                </div>
                <div>
                    {{ Form::label($trustReceiverMultiplierKey, 'Receiver Multiplier') }}
                    {{ Form::text($trustReceiverMultiplierKey, Input::old($trustReceiverMultiplierKey)) }}
                </div>
            </fieldset>
            <fieldset>
                <legend>Task {{$trustTaskId}}: Dictator</legend>
                <div>
                    {{ Form::label($dictatorEndowmentKey, 'Dictator Endowment') }}
                    {{ Form::text($dictatorEndowmentKey, Input::old($dictatorEndowmentKey)) }}
                </div>
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