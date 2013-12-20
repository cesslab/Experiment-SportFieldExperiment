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
                @if($getGood)
                    <p>
                        Please choose one of the following three goods:
                    </p>
                    <div class="form-group {{ ($errors->has($good)) ? 'has-error' : '' }} ">
                        {{ Form::select($good, $goodOptions, 'default', ['class'=>'form-control']) }}
                        <span class="error">{{ $errors->first($good) }}</span>
                    </div>
                    <p>
                        At this moment, how much are you willing to pay for the good you selected?
                        Remember, the price you pay is chosen in a way such that it is in your best interest to
                        write down exactly the most you would be willing to pay for the good.
                        (Please choose an amount between $0 and ${{$endowment}}).
                    </p>
                @else
                    <p>
                        Since any commercial break could be the one chosen for cash payment, at each break you should think
                        about what you want to do at this moment in time.
                    </p>
                    <p>
                        At this moment, how much are you willing to pay for the good you selected at the beginning of
                        the game? Remember, the price you pay is chosen in a way such that it is in your best interest to
                        write down exactly the most you would be willing to pay for the good.
                        (Please choose an amount between $0 and ${{$endowment}}).
                    </p>
                @endif

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
