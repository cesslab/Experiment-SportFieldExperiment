<div class="form-group {{ ($errors->has($amountKey)) ? 'has-error' : '' }} ">
    <h4>Task {{$taskId}}</h4>
    <p><strong>You are a Receiver</strong>. Your pair member has been given <strong>${{$totalAmount}}</strong>. Enter the minimum amount you would be willing to accept from the Proposer.</p>
    {{ Form::text($amountKey, Input::old($amountKey), ['class'=>'form-control', 'type'=>'number', 'placeholder'=>'Minimum Acceptable Amount']) }}
    <span class="error">{{ $errors->first($amountKey) }}</span>
</div>
