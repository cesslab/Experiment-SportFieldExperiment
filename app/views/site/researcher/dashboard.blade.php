@extends('site.layouts.generic')

@section('content')
<a href="{{ $sessionUrl }}">Add New Session</a>
<p>Game States: Registration = 1, Pre-Game Hold = 2, Game Play = 3, Questionnaire = 4, Payoff = 5, Completed = 6</p>
    <table>
        <tr>
            <th>Session ID</th>
            <th>Number of Subjects</th>
            <th>Endowment</th>
            <th>Low Prize</th>
            <th>Mid Prize</th>
            <th>High Prize</th>
            <th>Gamble Probability</th>
            <th>Session State</th>
            <th>Manage Session</th>
        </tr>
        @foreach($sessions as $session)
            <tr>
                <td>{{ $session->id }}</td>
                <td>{{ $session->num_subjects }}</td>
                <td>{{ $session->willingnessPay->getEndowment() }}</td>
                <td>{{ $session->riskAversion->getLowPrize() }}</td>
                <td>{{ $session->riskAversion->getMidPrize() }}</td>
                <td>{{ $session->riskAversion->getHighPrize() }}</td>
                <td>{{ $session->riskAversion->getGambleProbability() }}</td>
                <td>
                    @if ($session->getState() == $sessionStartState)
                        <span>Started</span>
                    @else
                        <span>Stopped</span>
                    @endif
                </td>
                <td>
                    {{ Form::open(array('url'=>URL::to($updateSessionUrl), 'method'=>'post')) }}
                        @if ($session->getState() == $sessionStartState)
                            {{ Form::hidden($sessionStateKey, $sessionStartState) }}
                            {{ Form::submit('Stop') }}
                        @else
                            {{ Form::hidden($sessionStateKey, $sessionStopState) }}
                            {{ Form::submit('Start') }}
                        @endif
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
    </table>
<ul class="errors">
    @foreach($errors->all() as $message)
    <li>{{ $message }}</li>
    @endforeach
</ul>

    <table>
        <tr>
            <th>Subject ID</th>
            <th>Session ID</th>
            <th>User Name</th>
            <th>Game State</th>
        </tr>
        @foreach($subjects as $subject)
        <tr>
            <td>{{ $subject->id }}</td>
            <td>{{ $subject->session_id }}</td>
            <td>{{ $subject->user->user_name }}</td>
            <td>{{ $subject->getState() }}</td>
        </tr>
        @endforeach
    </table>
@stop