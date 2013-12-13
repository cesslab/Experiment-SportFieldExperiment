@extends('site.layouts.generic')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Commercial Break Entry: Task {{$taskId}}</h3>
            </div>
            <div class="panel-body">
                {{ Form::open(array('url'=>$postUrl, 'method'=>'post', 'role'=>'form')) }}
                <p>
                    Individuals sometimes change their mind about what they are willing to pay for a good.
                </p>

                <p>
                    Right now, how much are you be willing to pay for the ${{$endowment}} store gift card you selected
                    at the beginning of the game? (Please choose an amount between $0 and ${{$endowment}}).
                </p>
                <p>
                    Remember, you will not pay the amount you enter. Instead, you will receive $50 and
                    pay a randomly chosen price if that price is below the amount you enter. As explained at
                    the beginning of the game, it is in your best interest to write down exactly the
                    most you would be willing to pay for the gift card (and not more or less than the most you would be willing to pay).
                </p>

                <div class="form-group {{ ($errors->has($willingPayKey)) ? 'has-error' : '' }} ">
                    {{ Form::text($willingPayKey, Input::old($willingPayKey), ['class'=>'form-control', 'type'=>'number', 'placeholder'=>'Amount Willing to Pay']) }}
                    <span class="error">{{ $errors->first($willingPayKey) }}</span>
                </div>
                {{ Form::button('Submit', ['type'=>'submit', 'class'=>'btn btn-primary']) }}
                {{ Form::close() }}

            </div>
        </div>
    </div>
</div>
@stop
