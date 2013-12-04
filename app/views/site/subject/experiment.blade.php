@extends('site.layouts.generic')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Commercial Break Entry</h3>
            </div>
            <div class="panel-body">
                {{ Form::open(array('url'=>$postUrl, 'method'=>'post', 'role'=>'form')) }}

                    @if ($displayRiskAversion)
                        @include('site.subject.experiment.treatment.riskAversion', array('taskId'=>$riskAversionTaskId, 'midPrize'=>$midPrize, 'lowPrize'=>$lowPrize, 'highPrize'=>$highPrize, 'indifferenceProbabilityKey'=>$indifferenceProbabilityKey))
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

                    {{ Form::button('Save Choices', ['type'=>'submit', 'class'=>'btn btn-primary']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop
