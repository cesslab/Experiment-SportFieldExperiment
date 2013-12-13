<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Commercial Break Entry: Task {{$taskId}}</h3>
            </div>
            <div class="panel-body">
                {{ Form::open(array('url'=>$postUrl, 'method'=>'post', 'role'=>'form')) }}
                <p>
                    Individuals sometimes change their mind about how they want to interact with others.
                </p>

                <p>
                    Player A: Please choose how much you would like to transfer to the randomly selected,
                    anonymous person in this room who is playing in the role of Player B.
                    Remember any amount you transfer to Player B is multiplied by 3. Player B can
                    choose to transfer back to you any amount of money he or she would like, up to
                    the amount he or she receives from your transfer.
                </p>

                <div class="form-group {{ ($errors->has($allocationKey)) ? 'has-error' : '' }} ">
                    <p><strong>You are a Proposer</strong>. Select one of the four possible amounts to send to the receiver.</p>
                    {{ Form::select($allocationKey, $proposerAllocationOptions, '--', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($allocationKey) }}</span>
                </div>
                {{ Form::button('Submit', ['type'=>'submit', 'class'=>'btn btn-primary']) }}
                {{ Form::close() }}

            </div>
        </div>
    </div>
</div>
