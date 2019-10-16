@extends('layout.mainlayout')

@section('content')

    <!-- Table -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
        <h5></h5>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
            <a href="{{ route('newProvider') }}"><button type="button" class="btn btn-sm btn-outline-success">Add Provider</button></a>
            </div>
        </div>
    </div>
    <div class="mb-4">
        <table class="table table-striped provider_listing" width="100%">
            <thead>
                <tr>
                    <th></th>
                    <th>NPI</th>
                    <th>Name</th>
                    <th>Specialty</th>
                    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('msmc-manager'))
                        <th>View Logs</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            @if(!empty($doctors))
                @foreach($doctors as $row)
                <tr>
                    <th>{{$row['id']}}</th>
                    <td><a href="{{url('/editProvider/'.$row['id'])}}">{{$row['npi']}}</a></td>
                    <td>{{$row['first_name'].' '.$row['last_name']}}</td>
                    <td>{{$row['primary_speciality']}}</td>
                    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('msmc-manager'))
                        <td><a href="{{url('/viewProviderLog/'.$row['id'])}}" class="btn btn-sm btn-primary"><span data-feather='eye'></span></a></td>
                    @endif
                </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

@endsection
@section('pagecss')
<link rel="stylesheet" type="text/css" href="{{url('/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('pagescript')
<script>
    $('#main_header').html("Provider");
</script>


<script src="{{url('/js/jquery_validation/jquery.validate.js')}}"></script>
<script src="{{url('/js/jquery_validation/additional-methods.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('/js/provider.js')}}"></script>
@endsection
