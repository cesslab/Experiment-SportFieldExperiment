<h2>Task {{$taskId}}</h2>

<p>You are a Proposer</p>
<p>You have been given ${{$totalAmount}}. How much of the ${{$totalAmount}} would you like to split with your pair member.</p>
<div>
    {{ Form::label($amountKey, "Split Amount") }}
    {{ Form::text($amountKey, Input::old($amountKey)) }}
</div>
