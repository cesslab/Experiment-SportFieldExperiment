<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Commercial Break Entry: Task {{$taskId}}</h3>
            </div>
            <div class="panel-body">
                {{ Form::open(array('url'=>$postUrl, 'method'=>'post', 'role'=>'form')) }}

                @if($getCharity)
                    <p>
                        Please choose one of the following three charities:
                    </p>
                    <div class="form-group {{ ($errors->has($charity)) ? 'has-error' : '' }} ">
                        {{ Form::select($charity, $charityOptions, 'default', ['class'=>'form-control']) }}
                        <span class="error">{{ $errors->first($charity) }}</span>
                    </div>
                @else
                <p>
                    Since any commercial break could be the one chosen for cash payment, at each break you should think
                    about what you want to do at this moment in time.
                </p>
                @endif
                <p>
                    At this moment, how much of your ${{$endowment}} do you want to donate to the charity you
                    selected at the start of the game? (Please choose an amount between $0 and ${{$endowment}}.)
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
