<div class="form-group {{ ($errors->has($allocationKey)) ? 'has-error' : '' }} ">
    <h4>Task {{$taskId}}</h4>
    <p><strong>You are a Receiver</strong>. Enter the amount you would be willing to send to the proposer for each value received.</p>
    @for($i = 0; $i < count($receiverAllocationOptions); ++$i)
        <div>
           <label>If Proposer Sent: {{$receiverAllocationOptions[$i]}}</label>
            {{ Form::text($allocationKey."[".$receiverAllocationOptions[$i]."]", Input::old($allocationKey."[".$receiverAllocationOptions[$i]."]"), ['class'=>'form-control', 'type'=>'number', 'placeholder'=>'']) }}
            <span class="error">{{ $errors->first($allocationKey.".".$receiverAllocationOptions[$i]) }}</span>
        </div>
    @endfor
</div>
