<h2>Task {{$taskId}}</h2>

<p>You are a Receiver</p>
<p>Your pair member has been given ${{$totalAmount}}. What is the minimum amount you would be willing to accept.
<div>
    {{ Form::label($amountKey, "Minimum Acceptable Amount") }}
    {{ Form::text($amountKey, Input::old($amountKey)) }}
</div>
