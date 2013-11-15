<h2>Task {{$taskId}}</h2>
<div>
    {{ Form::label($willingPayKey, "How much would you be willing to pay out of \$$endowment dollars?") }}
    {{ Form::text($willingPayKey, Input::old($willingPayKey)) }}
</div>
