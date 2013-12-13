<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Commercial Break Entry: Task {{$taskId}}</h3>
            </div>
            <div class="panel-body">

                {{ Form::open(array('url'=>$postUrl, 'method'=>'post', 'role'=>'form')) }}
                <div class="form-group {{ ($errors->has($amountKey)) ? 'has-error' : '' }} ">
                    <p><strong>You are a Proposer</strong>. You have been given <strong>${{$totalAmount}}</strong>.
                        How much of the <strong>${{$totalAmount}}</strong> would you like to split with your pair member.</p>
                    {{ Form::text($amountKey, Input::old($amountKey), ['class'=>'form-control', 'type'=>'number', 'placeholder'=>'Receiver Amount']) }}
                    <span class="error">{{ $errors->first($amountKey) }}</span>
                </div>
                {{ Form::button('Submit', ['type'=>'submit', 'class'=>'btn btn-primary']) }}
                {{ Form::close() }}

            </div>
        </div>
    </div>
</div>
