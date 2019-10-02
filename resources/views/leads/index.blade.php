@extends('layout.mainlayout')

@section('content')

    <!-- Table -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
        <h5>Leads</h5>
        @if(!Auth::user()->hasRole('agent_Manager'))
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
            <a href="{{ url('/newLead') }}"><button type="button" class="btn btn-sm btn-outline-success">New Lead</button></a>
            </div>
        </div>
        @endif
    </div>
    <div class="table-responsive">
        <table class="table table-striped" id="lead">
            <thead>
                <tr>
                    <th>Lead</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>DOB</th>
                    <th>Lead Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leads as $row)
                <tr>
                    <td><a href="{{url('/editLead/'.$row['id'])}}" name="edit" aria-label="Edit" title="Edit">{{ $row['id'] }}</a></td>
                    <td>{{ $row['fName'] . ' ' . $row['lName'] }}</td>
                    <td><span class="bfh-phone" data-format="(ddd) ddd-dddd" data-number="{{ $row['phone1'] }}"></span></td>
                    <td>{{ $row['dob'] }}</td>
                    @if($row['lStatus'] == 1 )
                        <td>New</td>
                    @elseif($row['lStatus'] == 2)
                        <td>Pending</td>
                    @elseif($row['lStatus'] == 3)
                        <td>Closed Success</td>
                    @elseif($row['lStatus'] == 4)
                        <td>Lost Failure</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
@section('pagescript')
<script>
    $('#main_header').html("Leads");
</script>

<script src="{{url('/js/jquery_validation/jquery.validate.js')}}"></script>
<script src="{{url('/js/jquery_validation/additional-methods.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('/js/lead.js')}}"></script>
@endsection
