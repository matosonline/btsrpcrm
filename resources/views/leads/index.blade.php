@extends('layout.mainlayout')

@section('content')

    <!-- Table -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
        <h5></h5>
        @if(!Auth::user()->hasRole('agent_Manager'))
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
            <a href="{{ url('/newLead') }}"><button type="button" class="btn btn-sm btn-outline-success">New Lead</button></a>
            </div>
        </div>
        @endif
    </div>
    <div class="mb-4">
        <table class="table table-striped lead_listing" id="lead" width="100%">
            <thead>
                <tr>
                    <th>Lead</th>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Lead Status</th> 
                    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('msmc-manager'))
                        <th>View Logs</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($leads as $row)
                <tr>
                    <td><a href="{{url('/editLead/'.$row['id'])}}" name="edit" aria-label="Edit" title="Edit">{{ $row['id'] }}</a></td>
                    <td>{{ $row['fName'] . ' ' . $row['lName'] }}</td>
                    <td>{{ $row['dob'] }}</td>
                    <td><a href="tel:{{$row['phone1']}}"><span class="bfh-phone" data-format="(ddd) ddd-dddd" data-number="{{ $row['phone1'] }}"></span></a></td>
                    <td>
                        <?php
                            $stateName = (new \App\Helpers\CommonHelper)->getStateName($row['inputState']) ;
                            $address = $row['inputAddress'].(($row['inputAddress2'] != '')?','.$row['inputAddress2']:'').(($row['inputCity'] != '')?','.$row['inputCity']:'').(($stateName != '')?','.$stateName['name']:'').(($row['inputZip'] != '')?','.$row['inputZip']:'');
                        ?>
                        <a href="http://maps.google.com/maps?q={{$address}}" target="_blank" title="address">{{$address}}</a>
                    @if($row['lStatus'] == 1 )
                        <td>New</td>
                    @elseif($row['lStatus'] == 2)
                        <td>Pending</td>
                    @elseif($row['lStatus'] == 3)
                        <td>Closed Success</td>
                    @elseif($row['lStatus'] == 4)
                       <td>Lost Failure</td>
                    @elseif($row['lStatus'] == 5)
                       <td>Appointment scheduled</td>
                    @elseif($row['lStatus'] == 6)
                        <td>Pending - No Answer</td>
                    @endif
                    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('msmc-manager'))
                        <td><a href="{{url('/viewLeadLog/'.$row['id'])}}" class="btn btn-sm btn-primary"><span data-feather='eye'></span></a></td>
                    @endif
               </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
@section('pagecss')
<link rel="stylesheet" type="text/css"
    href="{{url('/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{url('/assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
@endsection
@section('pagescript')
<script>
    $('#main_header').html("Leads");
</script>

<script src="{{url('/js/jquery_validation/jquery.validate.js')}}"></script>
<script src="{{url('/js/jquery_validation/additional-methods.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('/js/select2.min.js')}}"></script>
<script src="{{url('/js/lead.js')}}"></script>
@endsection
