<h2>Task 2</h2>
<p>
    There are three money prizes of {{$lowPrize}}, {{$midPrize}}, and {{$highPrize}} dollars.
    You have a choice of getting {{$midPrize}} dollars for sure or a gamble; where you can get ${{$highPrize}} dollar
    with a probability of {{$probability}}, or ${{$lowPrize}} dollars with a probability of 1 - {{$probability}}.
</p>

<p>
    Enter the probability that makes you indifferent between {{$midPrize}}, for sure, {{$highPrize}} with probability
    {{$probability}}, and {{$lowPrize}} with probability 1 - {{$probability}}.
</p>
<div>
    {{ Form::label('indifference_probability', "Your chosen probability") }}
    {{ Form::text('indifference_probability', '') }}
</div>
