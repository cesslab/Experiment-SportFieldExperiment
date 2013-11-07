@extends('site.layouts.generic')


@section('content')
{{ Form::open(array('url'=>$postUrl, 'method'=>'post')) }}

    @if ($displayWillingnessPay)
    @include('site.subject.experiment.treatment.willingnessPay', array('endowment'=>$endowment))
    @endif

    @if ($displayRiskAversion)
    @include('site.subject.experiment.treatment.riskAversion', array('midPrize'=>$midPrize, 'lowPrize'=>$lowPrize, 'highPrize'=>$highPrize, 'probability'=>$gambleProb))
    @endif

{{ Form::submit('Save Choices') }}

{{ Session::get('error', '') }}
<ul class="errors">
    @foreach($errors->all() as $message)
    <li>{{ $message }}</li>
    @endforeach
</ul>
{{ Form::close() }}
@stop
