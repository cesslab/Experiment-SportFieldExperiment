<div class="form-group {{ ($errors->has($allocationKey)) ? 'has-error' : '' }} ">
    <h4>Task {{$taskId}}</h4>
    <p>How much would you be willing to pay out of <strong>{{$endowment}}</strong> dollars?</p>
    {{ Form::text($willingPayKey, Input::old($willingPayKey), ['class'=>'form-control', 'placeholder'=>'Amount Willing to Pay']) }}
    <span class="error">{{ $errors->first($willingPayKey) }}</span>
</div>
