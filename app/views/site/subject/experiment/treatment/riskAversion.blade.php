<p>There are three money prizes of ${{$low_prize}}, ${{$mid_prize}}, and ${{$high_prize}}.  You have a choice of
getting {{$mid_prize}} for sure or a gamble: where you can get ${{$high_prize}} with a probability of {{$probability}},
or ${{$low_prize}} with a probability of 1 - {{$probability}}.</p>
{{ Form::label('indifference_probability', "Enter the probability that makes you indifferent between $mid_prize, for sure, $high_prize with probability $probability, and $low_prize with probability 1 - $probability.") }}
{{ Form::text('indifference_probability', '') }}
