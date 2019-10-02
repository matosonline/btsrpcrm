@extends('layout.mainlayout')

@section('content')
<div class="card-body">
        <div class="row">
           <div class="col-md-6 col-sm-12">
               <div class="table-responsive">
                    <form action="{{ route('user.editPassword') }}" method="POST" id="change_pass" name="change_pass">
                        @csrf
                        <div class="form-group">
                            <label for="password">Password <span class="error">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                                   autocomplete="off">
                            @if ($errors->has('password') && $errors->first('password') != 'The password confirmation does not match.')
                            <span class="error">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password <span class="error">*</span></label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                placeholder="Confirm Password">
                            @if ($errors->has('confirm_password'))
                            <span class="error">{{ $errors->first('confirm_password') }}</span>
                            @elseif($errors->has('password') && $errors->first('password') == 'The password confirmation does not match.')
                            <span class="error">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        
                        <button type="submit" class="btn btn-success mr-2" name="save_pass" id="save_pass">Save</button>
                        <button type="button" class="btn btn-dark" onClick="location.href='{{url('/dashboard')}}'">Cancel</button>
                   </form>
                </div>
           </div>
       </div>
</div>
@endsection
@section('pagescript')
<script>
    $('#main_header').html('Change Password');
</script>
<script src="{{url('/js/jquery_validation/jquery.validate.js')}}"></script>
<script src="{{url('/js/jquery_validation/additional-methods.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('/js/user.js')}}"></script>
@endsection