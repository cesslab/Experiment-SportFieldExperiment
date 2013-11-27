@extends('site.layouts.generic')

@section('content')
<h3>Task {{$riskAversionTaskId}} Payoff: ${{$riskAversionPayoff}}</h3>

<h3>Task {{$willingnessPayTaskId}} Payoff: ${{$willingnessPayPayoff}}</h3>

@if ($itemPurchased)
<h3>Task {{$willingnessPayTaskId}} Item: Purchased</h3>
@else
<span>Task {{$willingnessPayTaskId}} item: Not Purchased</span>
@endif

<h3>Task {{$ultimatumTaskId}} Payoff: ${{$ultimatumPayoff}}</h3>

<h3>Task {{$trustTaskId}} Payoff: ${{$trustPayoff}}</h3>

<h2>Total Payoff: ${{$totalPayoff}}</h2>
<h2>Total Items Purchased: {{$itemPurchased}}</h2>
{{ Form::open(array('url'=>$postUrl, 'method'=>'post')) }}
{{ Form::submit('Next') }}
{{ Form::close() }}
@stop
