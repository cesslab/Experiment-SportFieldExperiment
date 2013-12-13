<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Commercial Break Entry: Task {{$taskId}}</h3>
            </div>
            <div class="panel-body">

                {{ Form::open(array('url'=>$postUrl, 'method'=>'post', 'role'=>'form')) }}
                <div class="form-group {{ ($errors->has($amountKey)) ? 'has-error' : '' }} ">
                    <p><strong>You are a Receiver</strong>. Your pair member has been given <strong>${{$totalAmount}}</strong>. Enter the minimum amount you would be willing to accept from the Proposer.</p>
                    {{ Form::text($amountKey, Input::old($amountKey), ['class'=>'form-control', 'type'=>'number', 'placeholder'=>'Minimum Acceptable Amount']) }}
                    <span class="error">{{ $errors->first($amountKey) }}</span>
                </div>
                {{ Form::button('Submit', ['type'=>'submit', 'class'=>'btn btn-primary']) }}
                {{ Form::close() }}

            </div>
        </div>
    </div>
</div>
