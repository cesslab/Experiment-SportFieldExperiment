<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Commercial Break Entry: Task {{$taskId}}</h3>
            </div>
            <div class="panel-body">
                {{ Form::open(array('url'=>$postUrl, 'method'=>'post', 'role'=>'form')) }}

                @if( ! $isFirstEntry)
                <p>
                    Since any commercial break could be the one chosen for cash payment, at each break you should think
                    about what you want to do at this moment in time.
                </p>
                @endif
                <p>
                    At this moment, how much money would you like to transfer back to the randomly selected, anonymous
                    person in this room who is playing in the role of Player A. Please choose a transfer (in dollars)
                    back for each of the amounts of money that Player A might have transferred to you.
                </p>
                <p>
                    <strong>You are Player B</strong>. Select one of the four possible dollar amounts to send to <strong>Player A</strong>.
                </p>
                <div class="form-group {{ ($errors->has($allocationKey)) ? 'has-error' : '' }} ">
                    @for($i = 0; $i < count($receiverAllocationOptions); ++$i)
                    <div>
                        <label>If Player A sent ${{$receiverAllocationOptions[$i] / $receiverMultiplier}} and you received ${{$receiverAllocationOptions[$i]}}</label>
                        {{ Form::text($allocationKey."[".$receiverAllocationOptions[$i]."]", Input::old($allocationKey."[".$receiverAllocationOptions[$i]."]"), ['class'=>'form-control', 'type'=>'number', 'placeholder'=>'']) }}
                        <span class="error">{{ $errors->first($allocationKey.".".$receiverAllocationOptions[$i]) }}</span>
                    </div>
                    @endfor
                </div>
                {{ Form::button('Submit', ['type'=>'submit', 'class'=>'btn btn-primary']) }}
                {{ Form::close() }}

            </div>
        </div>
    </div>
</div>
