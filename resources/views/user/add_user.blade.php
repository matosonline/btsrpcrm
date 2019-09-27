@extends('layout.mainlayout')

@section('content')
<div class="card col-8 mx-auto p-3">
    <form method="post" id="store_user_data" name="store_user_data" action="{{url('/user/store_user_details')}}">
        @csrf
        @if(isset($action) && $action == 'edit')
        <input type="hidden" name="user_id" value="{{$user_details->id}}">
        <div class="form-group">
            <label for="role">Role <span class="error">*</span></label>
            <select id="role" name="role" class="form-control">
                <option value="">Select Role</option>
                @foreach($roles as $role)
                <option value="{{$role->id}}" {{(!empty($role) && in_array($role->id,$user_role))?'selected':''}}>
                    {{$role->name}}</option>
                @endforeach
            </select>
            @if ($errors->has('role'))
            <span class="error">{{ $errors->first('role') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="first_name">First Name <span class="error">*</span></label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name"
                value="{{$user_details->first_name}}">
            @if ($errors->has('first_name'))
            <span class="error">{{ $errors->first('first_name') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="last_name">Last Name <span class="error">*</span></label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name"
                value="{{$user_details->last_name}}">
            @if ($errors->has('last_name'))
            <span class="error">{{ $errors->first('last_name') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="email">Email <span class="error">*</span></label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                value="{{$user_details->email}}">
            @if ($errors->has('email'))
            <span class="error">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="phone_number">Phone</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number"
                value="{{$user_details->phone_number}}">
        </div>
        <div class="form-group">
            <label for="password">Password <span class="error">*</span></label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                   value="{{($user_details->password)}}" autocomplete="off">
            @if ($errors->has('password') && $errors->first('password') != 'The password
            confirmation does not match.')
            <span class="error">{{ $errors->first('password') }}</span>
            @endif
        </div>
        @else
        <div class="form-group">
            <label for="role">Role <span class="error">*</span></label>
            <select id="role" name="role" class="form-control">
                <option value="">Select Role</option>
                @foreach($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
            @if ($errors->has('role'))
            <span class="error">{{ $errors->first('role') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="first_name">First Name <span class="error">*</span></label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name"
                value="{{old('first_name')}}">
            @if ($errors->has('first_name'))
            <span class="error">{{ $errors->first('first_name') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="last_name">Last Name <span class="error">*</span></label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name"
                value="{{old('last_name')}}">
            @if ($errors->has('last_name'))
            <span class="error">{{ $errors->first('last_name') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="email">Email <span class="error">*</span></label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                value="{{old('email')}}">
            @if ($errors->has('email'))
            <span class="error">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone"
                value="{{old('phone_number')}}">
        </div>
        <div class="form-group">
            <label for="password">Password <span class="error">*</span></label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            @if ($errors->has('password') && $errors->first('password') != 'The password
            confirmation does not match.')
            <span class="error">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password <span class="error">*</span></label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                placeholder="Confirm Password">
            @if ($errors->has('confirm_password'))
            <span class="error">{{ $errors->first('confirm_password') }}</span>
            @elseif($errors->has('password') && $errors->first('password') == 'The password
            confirmation does not match.')
            <span class="error">{{ $errors->first('password') }}</span>
            @endif
        </div>
        @endif

        <button type="submit" class="btn btn-success mr-2" name="add_user"
            id="add_user">{{isset($action) && $action == 'edit'?'Update':'Add'}}</button>
        <button type="button" class="btn btn-dark" onClick="location.href='{{url('/users')}}'">Cancel</button>
    </form>
</div>
@endsection
@section('pagescript')
@if(isset($action) && $action == 'edit')
<script>
    $('#main_header').html('Edit User');
</script>
@else
<script>
    $('#main_header').html('Add User');
</script>
@endif
<script src="{{url('/js/jquery_validation/jquery.validate.js')}}"></script>
<script src="{{url('/js/jquery_validation/additional-methods.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('/js/user.js')}}"></script>
@endsection