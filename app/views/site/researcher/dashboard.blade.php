@extends('site.layouts.generic')

@section('content')
<meta http-equiv="Refresh" content="20">

<a href="{{ $sessionUrl }}">Add New Session</a>
    <table border="1">
        <tr>
            <th>Session ID</th>
            <th>Number of Subjects</th>
            <th>Endowment</th>
            <th>Low Prize</th>
            <th>Mid Prize</th>
            <th>High Prize</th>
            <th>Gamble Probability</th>
            <th>Ultimatum Amount</th>
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
                <td>{{ $session->getUltimatumTreatment()->getTotalAmount() }}</td>
                <td>
                    @if ($session->getState() == $sessionStartState)
                        <span>Started</span>
                    @else
                        <span>Stopped</span>
                    @endif
                </td>
                <td>
                    {{ Form::open(array('url'=>$postUrl, 'method'=>'post')) }}
                        {{ Form::hidden($sessionIdKey, $session->getId()) }}
                        @if ($session->getState() == $sessionStartState)
                            {{ Form::hidden($sessionStateKey, $sessionStopState) }}
                            {{ Form::submit('Stop') }}
                        @else
                            {{ Form::hidden($sessionStateKey, $sessionStartState) }}
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

    <table border="1">
        <tr>
            <th>Subject ID</th>
            <th>Session ID</th>
            <th>User Name</th>
            <th>Game State</th>
            <th>Ultimatum Role</th>
        </tr>
        @foreach($subjects as $subject)
        <tr>
            <td>{{ $subject->id }}</td>
            <td>{{ $subject->session_id }}</td>
            <td>{{ $subject->user->user_name }}</td>
            @if ($subject->getState() == $registrationState)
                <td>Registration</td>
            @elseif ($subject->getState() == $holdState)
                <td>Hold</td>
            @elseif ($subject->getState() == $gameState)
                <td>Game</td>
            @elseif ($subject->getState() == $payoffState)
                <td>Payoff</td>
            @elseif ($subject->getState() == $questionnaireState)
                <td>Questionnaire</td>
            @elseif ($subject->getState() == $completedState)
                <td>Completed</td>
            @else
                <td>Undeclared</td>
            @endif

            @if ($subject->getUltimatumGroup()->getSubjectRole() == $ultimatumProposerRoleId)
                <td>Proposer</td>
            @else
                <td>Receiver</td>
            @endif
        </tr>
        @endforeach
    </table>
@stop