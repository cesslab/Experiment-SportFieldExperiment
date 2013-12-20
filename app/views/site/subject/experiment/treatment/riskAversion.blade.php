<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Commercial Break Entry: Task {{$taskId}}</h3>
            </div>
            <div class="panel-body">

                {{ Form::open(array('url'=>$postUrl, 'method'=>'post', 'role'=>'form')) }}
                <div class="form-group {{ ($errors->has($gamblePayment)) ? 'has-error' : '' }} ">
                    @if( ! $isFirstEntry)
                    <p>
                        Since any commercial break could be the one chosen for cash payment, at each break you should
                        think about what you want to do at this moment in time.
                    </p>
                    @endif
                    <p>
                        At this moment, how much are you willing to pay for the risky gamble that pays ${{$lowPrize}}
                        with {{ (1-$gambleProbability) * 100}}% probability and ${{$highPrize}}
                        with {{ $gambleProbability * 100}} probability?
                    </p>
                    <p>
                        Remember, the price you pay is chosen in a way such that it is in your best interest to write
                        down exactly the most you would be willing to pay for the risky gamble.
                        (Please choose an amount between $0 and ${{$endowment}}).
                    </p>
                    {{ Form::text($gamblePayment, Input::old($gamblePayment), ['class'=>'form-control', 'type'=>'number', 'placeholder'=>'Amount Willing to Pay']) }}
                    <span class="error">{{ $errors->first($gamblePayment) }}</span>
                </div>
                {{ Form::button('Submit', ['type'=>'submit', 'class'=>'btn btn-primary']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
