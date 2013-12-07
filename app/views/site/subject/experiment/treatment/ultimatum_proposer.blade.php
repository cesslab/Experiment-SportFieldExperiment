<div class="form-group {{ ($errors->has($amountKey)) ? 'has-error' : '' }} ">
    <h4>Task {{$taskId}}</h4>
    <p><strong>You are a Proposer</strong>. You have been given <strong>${{$totalAmount}}</strong>.
        How much of the <strong>${{$totalAmount}}</strong> would you like to split with your pair member.</p>
    {{ Form::text($amountKey, Input::old($amountKey), ['class'=>'form-control', 'type'=>'number', 'placeholder'=>'Receiver Amount']) }}
    <span class="error">{{ $errors->first($amountKey) }}</span>
</div>
