<h2>Task {{$taskId}}</h2>

<p>You are a Receiver</p>
<p>Enter the amount you would be willing to send to the receiver for each value.</p>
<table>
    <tr>
        @for($i = 0; $i < count($receiverAllocationOptions); ++$i)
        <td>
            {{$receiverAllocationOptions[$i]}}
        </td>
        @endfor
    </tr>
    <tr>
        @for($i = 0; $i < count($receiverAllocationOptions); ++$i)
        <td>
            {{ Form::text($allocationKey."[".$receiverAllocationOptions[$i]."]", Input::old($allocationKey."[".$receiverAllocationOptions[$i]."]")) }}
        </td>
        @endfor
    </tr>
</table>
