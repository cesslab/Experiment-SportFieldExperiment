<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Commercial Break Entry: Task {{$taskId}}</h3>
            </div>
            <div class="panel-body">
                {{ Form::open(array('url'=>$postUrl, 'method'=>'post', 'role'=>'form')) }}

                <p>
                    Individuals sometimes change their mind about how much they want to donate to charity.
                </p>
                <p>
                    Right now, how much of your ${{$endowment}} do you want to donate to the charity you selected at the
                    start of the game? (Please choose an amount between $0 and ${{$endowment}}).
                </p>
                <p>
                    Remember, if this decision is randomly selected for payment, you will receive ${{$endowment}} minus
                    the amount you decided to donate to the charity and the charity will receive the amount you decided to donate to the charity.
                </p>

                    <div class="form-group {{ ($errors->has($allocationKey)) ? 'has-error' : '' }} ">
                    {{ Form::text($allocationKey, Input::old($allocationKey), ['class'=>'form-control', 'placeholder'=>'Charity Amount', 'type'=>'number']) }}
                    <span class="error">{{ $errors->first($allocationKey) }}</span>
                </div>
                {{ Form::button('Submit', ['type'=>'submit', 'class'=>'btn btn-primary']) }}
                {{ Form::close() }}

            </div>
        </div>
    </div>
</div>
