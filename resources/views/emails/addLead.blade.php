<<<<<<< HEAD
{{-- {{$data['formData']['fName'].' '.$data['formData']['lName']}},<!-- this should be Agent Name, not Lead name -->  --}}

You have been assigned a new lead. Please <a href="{{url('/editLead/'.$data['formData']['id'])}}" title="click">click here</a> to view.
=======
{{$data['getAgentData']['first_name'].' '.$data['getAgentData']['last_name']}}, you have been assigned a new lead. Please <a href="{{url('/editLead/'.$data['formData']['id'])}}" title="click">click here</a> to view.
>>>>>>> development_branch



