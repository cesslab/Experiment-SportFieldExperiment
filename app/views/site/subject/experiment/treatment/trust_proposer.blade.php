<div class="form-group {{ ($errors->has($allocationKey)) ? 'has-error' : '' }} ">
    <h4>Task {{$taskId}}</h4>
    <p><strong>You are a Proposer</strong>. Select one of the four possible amounts to send to the receiver.</p>
    {{ Form::select($allocationKey, $proposerAllocationOptions, '--', ['class'=>'form-control']) }}
    <span class="error">{{ $errors->first($allocationKey) }}</span>
</div>
