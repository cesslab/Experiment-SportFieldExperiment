<div class="form-group {{ ($errors->has($allocationKey)) ? 'has-error' : '' }} ">
    <h4>Task {{$taskId}}</h4>
    <p><strong>You are a Proposer</strong>. You have been given ${{$totalAmount}}.
        How much of the ${{$totalAmount}} would you like to split with your pair member.</p>
    {{ Form::text($amountKey, Input::old($amountKey), ['class'=>'form-control', 'placeholder'=>'Receiver Amount']) }}
    <span class="error">{{ $errors->first($amountKey) }}</span>
</div>
