@extends('site.layouts.generic')

@section('content')
<div class="jumbotron">
    <h1>Your payoff is displayed below.</h1>
    <p>
    @if ($riskAversionActive)
        <h4>Task {{$riskAversionTaskId}} Payoff: ${{$riskAversionPayoff}}</h4>
    @endif

    @if ($willingnessPayActive)
        <h4>Task {{$willingnessPayTaskId}} Payoff: ${{$willingnessPayPayoff}}</h4>
        @if ($itemPurchased)
            <h4>Task {{$willingnessPayTaskId}} Item: Purchased</h4>
        @else
            <span>Task {{$willingnessPayTaskId}} item: Not Purchased</span>
        @endif
    @endif

    @if ($ultimatumActive)
        <h4>Task {{$ultimatumTaskId}} Payoff: ${{$ultimatumPayoff}}</h4>
    @endif

    @if ($trustActive)
        <h4>Task {{$trustTaskId}} Payoff: ${{$trustPayoff}}</h4>
    @endif

    @if ($dictatorActive)
        <h4>Task {{$dictatorTaskId}} Payoff: ${{$dictatorPayoff}}</h4>
    @endif
    </p>

    {{ Form::open(array('url'=>$postUrl, 'method'=>'post')) }}
    {{ Form::button('Next', ['type'=>'submit', 'class'=>'btn btn-primary btn-lg'] ) }}
    {{ Form::close() }}
</div>


@stop
