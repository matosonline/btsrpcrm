@extends('layout.mainlayout')

@section('content')

<!-- Table -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
    <h5>Users</h5>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a href="{{ url('/user/add_new_user') }}"><button type="button" class="btn btn-sm btn-outline-success">New
                    User</button></a>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped" id="user_list">
        <thead>
            <tr>
                <th>Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                @if(Auth::user()->hasRole('Admin')) 
                <th>Last Login</th>
                @endif
                <th>Action</th>
                @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('msmc-manager'))
                    <th>View Logs</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @php
            $i=1;
            @endphp
            @foreach($users as $row)
            <tr>
                <td>{{ $i}}</td>
                <td>{{ $row->first_name }}</td>
                <td>{{ $row->last_name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->phone_number }}</td>
                @if(Auth::user()->hasRole('Admin')) 
                <td>{{ $row->last_login }}</td>
                @endif
                <td>
                    <a class="btn" href="{{url('user/edit/'.$row->id)}}" type="button" name="edit" aria-label="Edit"
                        title="Edit"><i class="fa fas fa-edit"></i></a>
                    <a class="btn sa-confirm" type="button" name="delete" aria-label="Delete" title="Delete" id="delete"
                        user_id="{{$row->id}}"><i class="fa fas fa-trash"></i></a>
                </td>
                @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('msmc-manager'))
                    <td><a href="{{url('/viewUserLog/'.$row->id)}}"><span data-feather='eye'></span></a></td>
                @endif

            </tr>
            @php
            $i=$i+1;
            @endphp
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
    $('#main_header').html('Users');
</script>
<script src="{{url('/js/jquery_validation/jquery.validate.js')}}"></script>
<script src="{{url('/js/jquery_validation/additional-methods.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('/js/user.js')}}"></script>
@endsection