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
                Player B: Please choose how much you would like to transfer back to the randomly
                selected, anonymous person in this room who is playing in the role of Player A.
                Please choose a transfer back for each of the amounts of money that Player A might have transferred to you.
                <p>
                <div class="form-group {{ ($errors->has($allocationKey)) ? 'has-error' : '' }} ">
                    </p>
                    @for($i = 0; $i < count($receiverAllocationOptions); ++$i)
                    <div>
                        <label>If Proposer Sent: {{$receiverAllocationOptions[$i]}}</label>
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
