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
                    At this moment, how much money would you like to transfer to the randomly selected, anonymous person
                    in this room who is playing the role of Player B. Remember, any amount you transfer is multiplied by
                    3. Player B can transfer back any amount of money he or she would like, up to the amount he or
                    she receives from your transfer.
                </p>

                <div class="form-group {{ ($errors->has($allocationKey)) ? 'has-error' : '' }} ">
                    <p>You are <strong>Player A</strong>. Select one of the four possible amounts to send to <strong>Player B</strong></p>
                    {{ Form::select($allocationKey, $proposerAllocationOptions, '--', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($allocationKey) }}</span>
                </div>
                {{ Form::button('Submit', ['type'=>'submit', 'class'=>'btn btn-primary']) }}
                {{ Form::close() }}

            </div>
        </div>
    </div>
</div>
