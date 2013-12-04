@extends('site.layouts.dashboard-layout')

@section('navbar')
    <li class="active"><a href="{{URL::to('researcher/dashboard')}}"><i class="fa fa-dashboard fa-lg fa-fw"></i> Home</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-plus"></i> <i class="fa fa-users fa-lg fa-fw"></i> Add Session</a>
    </li>
@stop

@section('error-message')
    @if ( $error )
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <span>{{(isset($error))? $error : ''}}</span>
        </div>
    @endif
@stop

@section('content')
<meta http-equiv="Refresh" content="20">


<div class="row">
    <div class="col-lg-12">
        <h2>Sessions</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover tablesorter">
                <thead>
                <tr>
                    <th>Session ID <i class="fa fa-sort"></i></th>
                    <th>Number of Subjects <i class="fa fa-sort"></i></th>
                    <th>Session State <i class="fa fa-sort"></i></th>
                    <th>Manage Session <i class="fa fa-sort"></i></th>
                </tr>
                </thead>
                <tbody>
                @foreach($sessions as $session)
                <tr>
                    <td>{{ $session->id }}</td>
                    <td>{{ $session->num_subjects }}</td>
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
                        {{ Form::button('Stop', ['type'=>'submit', 'class'=>'btn btn-danger']) }}
                        @else
                        {{ Form::hidden($sessionStateKey, $sessionStartState) }}
                        {{ Form::button('Start', ['type'=>'submit', 'class'=>'btn btn-success']) }}
                        @endif
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <h2>Subjects</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover tablesorter">
                <thead>
                <tr>
                    <th>Subject ID <i class="fa fa-sort"></i></th>
                    <th>Session ID <i class="fa fa-sort"></i></th>
                    <th>User Name <i class="fa fa-sort"></i></th>
                    <th>Game State <i class="fa fa-sort"></i></th>
                    <th>Ultimatum Role <i class="fa fa-sort"></i></th>
                </tr>
                </thead>
                <tbody>
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
                </tbody>
            </table>
        </div>
    </div>
</div><!-- /.row -->

@stop