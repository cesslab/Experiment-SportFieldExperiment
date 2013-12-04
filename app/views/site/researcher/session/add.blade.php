@extends('site.layouts.dashboard-layout')

@section('css')
@stop

@section('navbar')
<li class=""><a href="{{URL::to('researcher/dashboard')}}"><i class="fa fa-dashboard fa-lg fa-fw"></i> Home</a></li>
<li class="active">
    <a href="#"><i class="fa fa-plus"></i> <i class="fa fa-users fa-lg fa-fw"></i> Add Session</a>
</li>
@stop

@section('error')
    @if ( Session::get('error', false) )
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <span><strong>{{ Session::get('error') }}</strong></span>
        </div>
    @endif
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-users fa-lg fa-fw"></i>New Session</h3>
            </div>
            <div class="panel-body">
                {{ Form::open(array('url'=>$postUrl, 'method'=>'post', 'class'=>'form-horizontal', 'role'=>'form')) }}

                <!-- Number of Subjects -->
                <div class="form-group {{ ($errors->has($numSubjectsKey)) ? 'has-error' : '' }} ">
                    {{ Form::label($numSubjectsKey, 'Number of Subjects', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-sm-6">
                        {{ Form::text($numSubjectsKey, Input::old($numSubjectsKey), ['class'=>'form-control', 'placeholder'=>'Number of Subjects']) }}
                        <span class="error">{{ $errors->first($numSubjectsKey) }}</span>
                    </div>
                </div>

                <!-- Risk Aversion -->
                <div class="form-group">
                    <label class="col-sm-3 control-label lbl">Enable Risk Aversion Task {{$riskAversionTaskId}}</label>
                    <div class="col-sm-6">
                        {{ Form::checkbox('riskAversionEnabled', 'enabled', false, ['id'=>'riskAversionCheckbox', 'class'=>'hiddenChecker']) }}
                        <label class="styledBox"></label>
                    </div>
                </div>
                <div id="riskAversionGroup">
                    <div class="form-group {{ ($errors->has($lowPrizeKey)) ? 'has-error' : '' }} ">
                        {{ Form::label($lowPrizeKey, 'Low Prize', ['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-6">
                            {{ Form::text($lowPrizeKey, Input::old($lowPrizeKey), ['class'=>'form-control', 'placeholder'=>'Low Prize']) }}
                            <span class="error">{{ $errors->first($lowPrizeKey) }}</span>
                        </div>
                    </div>

                    <div class="form-group {{ ($errors->has($midPrizeKey)) ? 'has-error' : '' }} ">
                        {{ Form::label($midPrizeKey, 'Mid Prize', ['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-6">
                            {{ Form::text($midPrizeKey, Input::old($midPrizeKey), ['class'=>'form-control', 'placeholder'=>'Mid Prize']) }}
                            <span class="error">{{ $errors->first($midPrizeKey) }}</span>
                        </div>
                    </div>

                    <div class="form-group {{ ($errors->has($highPrizeKey)) ? 'has-error' : '' }} ">
                        {{ Form::label($highPrizeKey, 'High Prize', ['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-6">
                            {{ Form::text($highPrizeKey, Input::old($highPrizeKey), ['class'=>'form-control', 'placeholder'=>'High Prize']) }}
                            <span class="error">{{ $errors->first($highPrizeKey) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Willingness to Pay -->
                <div class="form-group">
                    <label class="col-sm-3 control-label">Enable Willingness To Pay Task {{$willingnessPayTaskId}}</label>
                    <div class="col-sm-6">
                        {{ Form::checkbox('willingnessPayEnabled', 'enabled', false, ['id'=>'willingnessPayCheckbox', 'class'=>'hiddenChecker']) }}
                        <label class="styledBox"></label>
                    </div>
                </div>
                <div id="willingnessPayGroup">
                    <div class="form-group {{ ($errors->has($endowmentKey)) ? 'has-error' : '' }} ">
                        {{ Form::label($endowmentKey, 'Endowment', ['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-6">
                            {{ Form::text($endowmentKey, Input::old($endowmentKey), ['class'=>'form-control', 'placeholder'=>'Endowment']) }}
                            <span class="error">{{ $errors->first($endowmentKey) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Ultimatum -->
                <div class="form-group">
                    <label class="col-sm-3 control-label">Enable Ultimatum Task {{$ultimatumTaskId}}</label>
                    <div class="col-sm-6">
                        {{ Form::checkbox('ultimatumEnabled', 'enabled', false, ['id'=>'ultimatumCheckbox', 'class'=>'hiddenChecker']) }}
                        <label class="styledBox"></label>
                    </div>
                </div>
                <div id="ultimatumGroup" class="form-group {{ ($errors->has($ultimatumTotalAmountKey)) ? 'has-error' : '' }} ">
                    {{ Form::label($ultimatumTotalAmountKey, 'Proposer Endowment', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-sm-6">
                        {{ Form::text($ultimatumTotalAmountKey, Input::old($ultimatumTotalAmountKey), ['class'=>'form-control', 'placeholder'=>'Proposer Endowment']) }}
                        <span class="error">{{ $errors->first($ultimatumTotalAmountKey) }}</span>
                    </div>
                </div>

                <!-- Trust -->
                <div class="form-group">
                    <label class="col-sm-3 control-label">Enable Trust Task {{$trustTaskId}}</label>
                    <div class="col-sm-6">
                        {{ Form::checkbox('trustEnabled', 'enabled', false, ['id'=>'trustCheckbox', 'class'=>'hiddenChecker']) }}
                        <label class="styledBox"></label>
                    </div>
                </div>
                <div id="trustGroup">
                    <div class="form-group {{ ($errors->has($trustSenderMultiplierKey)) ? 'has-error' : '' }} ">
                        {{ Form::label($trustSenderMultiplierKey, 'Sender Multiplier', ['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-6">
                            {{ Form::text($trustSenderMultiplierKey, Input::old($trustSenderMultiplierKey), ['class'=>'form-control', 'placeholder'=>'Sender Multiplier']) }}
                            <span class="error">{{ $errors->first($trustSenderMultiplierKey) }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ ($errors->has($trustReceiverMultiplierKey)) ? 'has-error' : '' }} ">
                        {{ Form::label($trustReceiverMultiplierKey, 'Receiver Multiplier', ['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-6">
                            {{ Form::text($trustReceiverMultiplierKey, Input::old($trustReceiverMultiplierKey), ['class'=>'form-control', 'placeholder'=>'Receiver Multiplier']) }}
                            <span class="error">{{ $errors->first($trustReceiverMultiplierKey) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Dictator -->
                <div class="form-group">
                    <label class="col-sm-3 control-label">Enable Dictator Task {{$dictatorTaskId}}</label>
                    <div class="col-sm-6">
                        {{ Form::checkbox('dictatorEnabled', 'enabled', false, ['id'=>'dictatorCheckbox', 'class'=>'hiddenChecker']) }}
                        <label class="styledBox"></label>
                    </div>
                </div>
                <div id="dictatorGroup" class="form-group {{ ($errors->has($dictatorEndowmentKey)) ? 'has-error' : '' }} ">
                    {{ Form::label($dictatorEndowmentKey, 'Dictator Endowment', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-sm-6">
                        {{ Form::text($dictatorEndowmentKey, Input::old($dictatorEndowmentKey), ['class'=>'form-control', 'placeholder'=>'Dictator Endowment']) }}
                        <span class="error">{{ $errors->first($dictatorEndowmentKey) }}</span>
                    </div>
                </div>
                {{ Form::button('Add Session', ['class'=>'btn btn-default', 'type'=>'submit']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
{{ HTML::script(URL::asset('assets/js/add-session.js')) }}
@stop