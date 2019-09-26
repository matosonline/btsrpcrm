<option value="">Choose..</option>
@foreach ( $agent_details as $agent )
    <option value="{{$agent->id}}">{{$agent->first_name ." ".$agent->last_name}}</option>
@endforeach