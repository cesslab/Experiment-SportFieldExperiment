@extends('site.layouts.generic')

@section('content')
<div class="jumbotron" xmlns="http://www.w3.org/1999/html">
    <h1>Your payoff is as follows:</h1>
    <div>
        <!-- Risk Aversion -->
        @if ($riskAversionActive)
            <h2>Task {{$riskAversionTaskId}} was randomly selected for payoff.</h2>
            <p>From the entries you made for this task a random commercial break entry was randomly selected.
                The payoff for this entry is <strong>${{$riskAversionPayoff}}</strong>.</p>
        @endif

        <!-- Willingness to Pay -->
        @if ($willingnessPayActive)
            <h2>Task {{$willingnessPayTaskId}} was randomly selected for payoff.</h2>
            <p>From the entries you made for this task a random commercial break entry was randomly selected.
                The payoff for this entry is <strong>${{$willingnessPayPayoff}}</strong>.</p>
            @if ($itemPurchased)
                <p>You have also purchased the item you selected.</p>
            @endif
        @endif

        <!-- Ultimatum -->
        @if ($ultimatumActive)
            <h2>Task {{$ultimatumTaskId}} was randomly selected for payoff.</h2>
            <p>From the entries you made for this task a random commercial break entry was randomly selected.
                The payoff for this entry is <strong> ${{$ultimatumPayoff}}</strong>.</p>
        @endif

        <!-- Trust -->
        @if ($trustActive)
        <h2>Task {{$trustTaskId}} was randomly selected for payoff.</h2>
        <p>From the entries you made for this task a random commercial break entry was randomly selected.
            The payoff for this entry is <strong> ${{$trustPayoff}}</strong>.</p>
        @endif

        <!-- Dictator -->
        @if ($dictatorActive)
        <h2>Task {{$dictatorTaskId}} was randomly selected for payoff.</h2>
        <p>From the entries you made for this task a random commercial break entry was randomly selected.
            The payoff for this entry is <strong> ${{$dictatorPayoff}}</strong>.</p>
        @endif

        {{ Form::open(array('url'=>$postUrl, 'method'=>'post')) }}
        {{ Form::button('Next', ['type'=>'submit', 'class'=>'btn btn-primary btn-lg'] ) }}
        {{ Form::close() }}
    </div>
</div>
@stop
