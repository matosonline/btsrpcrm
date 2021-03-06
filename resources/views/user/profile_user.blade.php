@extends('layout.mainlayout')

@section('content')
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
<div class="card-body">
        <div class="row">
           <div class="col-md-6 col-sm-12">
               <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                              <th>Name</th>
                              <td>{{$user_details['first_name'].' '.$user_details['last_name']}}</td>
                            </tr>
                            <tr>
                              <th>email</th>
                              <td>{{$user_details['email']}}</td>
                            </tr>
                            <tr>
                              <th>Phone</th>
                              <td>{{$user_details['phone_number']}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
           </div>
       </div>
    <div class="card-footer">
        <a class="btn btn-success" href="{{url('/changePassword')}}">Change Password</a>
    </div>
</div>
@endsection
@section('pagescript')
<script>
    $('#main_header').html('View Profile');
</script>
@endsection
