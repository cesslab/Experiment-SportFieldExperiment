<div class="form-group {{ ($errors->has($allocationKey)) ? 'has-error' : '' }} ">
    <h4>Task {{$taskId}}</h4>
    <p><strong>You are a Proposer</strong>. You have been given an endowment of <strong>{{$endowment}}</strong>.
    Enter the amount, you would like to send to a receiver out of this endowment.</p>
    {{ Form::text($allocationKey, Input::old($allocationKey), ['class'=>'form-control', 'placeholder'=>'Receiver Amount', 'type'=>'number']) }}
    <span class="error">{{ $errors->first($allocationKey) }}</span>
</div>
