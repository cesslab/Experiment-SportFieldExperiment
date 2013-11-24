<h2>Task {{$taskId}}</h2>

<p>You are a Proposer</p>
<p>Select one of the four possible amounts to send to the receiver.</p>
<p>
{{ Form::select($allocationKey, $proposerAllocationOptions, '--') }}
</p>
<div>
</div>
