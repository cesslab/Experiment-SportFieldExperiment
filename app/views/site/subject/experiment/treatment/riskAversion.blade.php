<div class="form-group {{ ($errors->has($allocationKey)) ? 'has-error' : '' }} ">
    <h4>Task {{$taskId}}</h4>
    <p>
        There are three money prizes of <strong>{{$lowPrize}}</strong>, <strong>{{$midPrize}}</strong>, and <strong>{{$highPrize}}</strong> dollars.
        You have a choice of getting <strong>{{$midPrize}}</strong> dollars for sure or a gamble; where you can get <strong>${{$highPrize}}</strong> dollar
        with a probability of <strong>{{$probability}}</strong>, or <strong>${{$lowPrize}}</strong> dollars with a probability of <strong>{{(1 - $probability)}} ({{(1 - $probability)*100}}%)</strong>.
    </p>
    <p>
        Enter the probability that makes you indifferent between <strong>{{$midPrize}}</strong>, for sure, <strong>{{$highPrize}}</strong> with probability
        <strong>{{$probability}}</strong>, and <strong>{{$lowPrize}}</strong> with probability of <strong>{{(1 - $probability)}}</strong>.
    </p>
    {{ Form::text($indifferenceProbabilityKey, Input::old($indifferenceProbabilityKey), ['class'=>'form-control', 'placeholder'=>'Your chosen probability']) }}
    <span class="error">{{ $errors->first($indifferenceProbabilityKey) }}</span>
</div>
