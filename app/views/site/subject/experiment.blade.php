@extends('site.layouts.generic')

@section('content')

@if ($displayTask)
    @if ($displayRiskAversion)
        @include('site.subject.experiment.treatment.riskAversion', array('endowment'=>$endowment, 'taskId'=>$riskAversionTaskId, 'gambleProbability'=>$gambleProbability, 'lowPrize'=>$lowPrize, 'highPrize'=>$highPrize, 'gamblePayment'=>$gamblePayment))
    @elseif ($displayWillingnessPay)
        @include('site.subject.experiment.treatment.willingnessPay', array('endowment'=>$endowment, 'taskId'=>$willingnessPayTaskId, 'willingPayKey'=>$willingPayKey))
    @elseif ($displayUltimatum)
        @if ($isUltimatumProposer)
            @include('site.subject.experiment.treatment.ultimatum_proposer', array('taskId'=>$ultimatumTaskId, 'totalAmount'=>$ultimatumTotalAmount, 'amountKey'=>$amountKey))
        @else
            @include('site.subject.experiment.treatment.ultimatum_receiver', array('taskId'=>$ultimatumTaskId, 'totalAmount'=>$ultimatumTotalAmount, 'amountKey'=>$amountKey))
        @endif
    @elseif ($displayTrust)
        @if ($isTrustProposer)
            @include('site.subject.experiment.treatment.trust_proposer', array('taskId'=>$trustTaskId, 'proposerAllocationOptions'=>$proposerAllocationOptions, 'numProposerAllocations'=>$numProposerAllocations, 'allocationKey'=>$allocationKey))
        @else
            @include('site.subject.experiment.treatment.trust_receiver', array('taskId'=>$trustTaskId, 'receiverAllocationOptions'=>$receiverAllocationOptions, 'numReceiverAllocations'=>$numReceiverAllocations, 'allocationKey'=>$allocationKey))
        @endif
    @elseif ($displayDictator)
        @include('site.subject.experiment.treatment.dictator', array('taskId'=>$dictatorTaskId, 'endowment'=>$dictatorEndowment, 'allocationKey'=>$dictatorAllocationKey))
    @endif
@else
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Game Questionnaire</h3>
            </div>

            <div class="panel-body">
                {{ Form::open(array('url'=>$postUrl, 'method'=>'post', 'class'=>'form-horizontal', 'role'=>'form')) }}

                {{-- Surprise Level --}}
                <div class="col-sm-11 form-group {{ ($errors->has($surpriseLevel)) ? 'has-error' : '' }} ">
                    {{ Form::label($surpriseLevel, 'How surprised are you about the recent events in the game?', ['class'=>'']) }}
                    {{ Form::select($surpriseLevel, $surpriseLevelOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($surpriseLevel) }}</span>
                </div>

                {{-- Excitation Level --}}
                <div class="col-sm-11 form-group {{ ($errors->has($excitationLevel)) ? 'has-error' : '' }} ">
                    {{ Form::label($excitationLevel, 'Do you like watching football in particular?', ['class'=>'']) }}
                    {{ Form::select($excitationLevel, $excitationLevelOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($excitationLevel) }}</span>
                </div>

                {{-- Happiness Level --}}
                <div class="col-sm-11 form-group {{ ($errors->has($happinessLevel)) ? 'has-error' : '' }} ">
                    {{ Form::label($happinessLevel, 'What is your favorite team?', ['class'=>'']) }}
                    {{ Form::select($happinessLevel, $happinessLevelOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($happinessLevel) }}</span>
                </div>

                {{-- Likeliness of Winning --}}
                <div class="col-sm-11 form-group {{ ($errors->has($likelinessWinningLevel)) ? 'has-error' : '' }} ">
                    {{ Form::label($likelinessWinningLevel, 'Which team are you rooting for in the game today?', ['class'=>'']) }}
                    {{ Form::select($likelinessWinningLevel, $likelinessWinningLevelOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($likelinessWinningLevel) }}</span>
                </div>

                <div class="col-sm-11">
                    {{ Form::button('Submit', ['type'=>'submit', 'class'=>'btn btn-default']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@endif

@stop
