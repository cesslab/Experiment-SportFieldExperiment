<h2>Task {{$taskId}}</h2>

<p>You are a Proposer</p>
<p>You have received an endowment of {{$endowment}}.
    Enter the amount you would like to give to the receiver.</p>
<p>
    {{ Form::text($allocationKey, Input::old($allocationKey)) }}
</p>
<div>
</div>
