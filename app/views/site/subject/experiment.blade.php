@extends('site.layouts.generic')


@section('content')
{{ Form::open(array('url'=>$postUrl, 'method'=>'post')) }}

    @if ($displayRiskAversion)
        @include('site.subject.experiment.treatment.riskAversion', array('taskId'=>$riskAversionTaskId, 'midPrize'=>$midPrize, 'lowPrize'=>$lowPrize, 'highPrize'=>$highPrize, 'probability'=>$gambleProb, 'indifferenceProbabilityKey'=>$indifferenceProbabilityKey))
    @endif

    @if ($displayWillingnessPay)
        @include('site.subject.experiment.treatment.willingnessPay', array('endowment'=>$endowment, 'taskId'=>$willingnessPayTaskId, 'willingPayKey'=>$willingPayKey))
    @endif

    @if ($displayUltimatum)
        @if ($isUltimatumProposer)
            @include('site.subject.experiment.treatment.ultimatum_proposer', array('taskId'=>$ultimatumTaskId, 'totalAmount'=>$ultimatumTotalAmount, 'amountKey'=>$amountKey))
        @else
            @include('site.subject.experiment.treatment.ultimatum_receiver', array('taskId'=>$ultimatumTaskId, 'totalAmount'=>$ultimatumTotalAmount, 'amountKey'=>$amountKey))
        @endif
    @endif

    @if ($displayTrust)
        @if ($isTrustProposer)
            @include('site.subject.experiment.treatment.trust_proposer', array('taskId'=>$trustTaskId, 'proposerAllocationOptions'=>$proposerAllocationOptions, 'numProposerAllocations'=>$numProposerAllocations, 'allocationKey'=>$allocationKey))
        @else
            @include('site.subject.experiment.treatment.trust_receiver', array('taskId'=>$trustTaskId, 'receiverAllocationOptions'=>$receiverAllocationOptions, 'numReceiverAllocations'=>$numReceiverAllocations, 'allocationKey'=>$allocationKey))
        @endif
    @endif

    @if ($displayDictator)
        @include('site.subject.experiment.treatment.dictator', array('taskId'=>$dictatorTaskId, 'endowment'=>$dictatorEndowment, 'allocationKey'=>$dictatorAllocationKey))
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
