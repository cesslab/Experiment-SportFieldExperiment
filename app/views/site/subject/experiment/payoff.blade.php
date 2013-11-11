@extends('site.layouts.generic')

@section('content')
<h3>Task 1 Payoff: ${{$riskAversionPayoff}}</h3>

<h3>Task 2 Payoff: ${{$willingnessPayPayoff}}</h3>
@if ($itemPurchased)
<h3>Task 2 Item: Purchased</h3>
@else
<span>Task 2 item: Not Purchased</span>
@endif

<h2>Total Payoff: ${{$totalPayoff}}</h2>
<h2>Total Items Purchased: {{$itemPurchased}}</h2>
{{ Form::open(array('url'=>$postUrl, 'method'=>'post')) }}
{{ Form::submit('Next') }}
{{ Form::close() }}
@stop
