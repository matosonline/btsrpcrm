@extends('layout.mainlayout')

@section('content')

    <!-- Table -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
                <h5></h5>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                    <a href="{{ url('/newCenter') }}"><button type="button" class="btn btn-sm btn-outline-success">Add Center</button></a>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                @if(count($center)>0)
                    <table class="table table-striped centerListingTable" width="100%">
                        <thead>
                            <tr>
                                <th>Center ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Action</th>
                                @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('msmc-manager'))
                                    <th>View Logs</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php $stateArray = array('AL','AK','AZ','AR','CA','CO','CT','DE','DC','FL','GA','HI','ID','IL','IN','IA','KS','KY','LA','ME','MD','MA','MI','MN','MS','MO','MT','NE','NV','NH','NJ','NM','NY','NC','ND','OH','OK','OR','PA','RI','SC','SD','TN','TX','UT','VT','VA','WA','WV','WI','WY','AS','PR','VI','GU');@endphp
                            @foreach($center as $row)
                            <tr>
                                <td>{{$row['id']}}</td>
                                <td>{{$row['centerName']}}</td>
                                <td>{{$row['inputAddress'].' '.$row['inputAddress2'].' '.$row['inputCity'].' '.$stateArray[$row['inputState']-1].' '.$row['inputZip']}}</td>
                                <td>{{$row['phone1']}}</td>
                                <td><a class="btn btn-sm btn-default" href="{{url('/editCenter/'.$row['id'])}}" name="edit" aria-label="Edit" title="Edit"><i class="fa fas fa-edit"></i></a></td>
                                @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('msmc-manager'))
                                    <td><a href="{{url('/viewCenterLog/'.$row['id'])}}" class="btn btn-sm btn-primary"><span data-feather='eye'></span></a></td>
                               @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

@endsection
@section('pagecss')
<link rel="stylesheet" href="{{url('/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{url('/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{url('/assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
@endsection
@section('pagescript')
<script>
    $('#main_header').html('Center');
</script>

<script src="{{url('/js/jquery_validation/jquery.validate.js')}}"></script>
<script src="{{url('/js/jquery_validation/additional-methods.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('/js/center.js')}}"></script>
@endsection
<b></b>