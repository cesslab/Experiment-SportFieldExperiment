<table id="subjectTable" class="table table-bordered table-hover tablesorter">
    <thead>
    <tr>
        <th>Session ID </th>
        <th>User Name </th>
        <th>Payoff Task ID</th>
        <th>Payoff </th>
        <th>Item Purchased </th>
        <th>Game State </th>
        <th>Commercial Entries</th>
    </tr>
    </thead>
    <tbody>
    @foreach($subjects as $subject)
    <tr>
        <td>{{ $subject->session_id }}</td>
        <td>{{ $subject->user->user_name }}</td>
        <td>{{ $subject->getPayoffTaskId() }}</td>
        <td>{{ $subject->getPayoff() }}</td>
        <td>{{ ($subject->getItemPurchased()) ? "Item Purchased" : "" }}</td>
        @if ($subject->getState() == $registrationState)
        <td>Registration</td>
        @elseif ($subject->getState() == $holdState)
        <td>Hold</td>
        @elseif ($subject->getState() == $gameState)
        <td>Game Play</td>
        @elseif ($subject->getState() == $payoffState)
        <td>Payoff</td>
        @elseif ($subject->getState() == $questionnaireState)
        <td>Questionnaire</td>
        @elseif ($subject->getState() == $completedState)
        <td>Completed</td>
        @elseif ($subject->getState() == $preGameQuestionnaireState)
        <td>Pre-Game Questionnaire</td>
        @else
        <td>Undeclared</td>
        @endif
        <td>{{ $subject->getSubjectEntryState()->getCommercialBreakEntry() }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
