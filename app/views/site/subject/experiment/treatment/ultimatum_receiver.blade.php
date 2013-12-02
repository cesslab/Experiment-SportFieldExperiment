<div class="form-group {{ ($errors->has($allocationKey)) ? 'has-error' : '' }} ">
    <h4>Task {{$taskId}}</h4>
    <p><strong>You are a Receiver</strong>. Your pair member has been given ${{$totalAmount}}. Enter the minimum amount you would be willing to accept from the Proposer.</p>
    {{ Form::text($amountKey, Input::old($amountKey), ['class'=>'form-control', 'placeholder'=>'Minimum Acceptable Amount']) }}
    <span class="error">{{ $errors->first($amountKey) }}</span>
</div>
