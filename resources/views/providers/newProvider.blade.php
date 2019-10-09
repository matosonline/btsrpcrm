@extends('layout.mainlayout')

@section('content')

@if(count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

    <div class="card col-8 mx-auto p-3">

        <form action="{{ route('provider.store') }}" method="POST" id="add_provider_form" name="add_provider_form">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fName">First Name</label>
                    <input type="text" name="fName" class="form-control" id="fName" placeholder="First Name">
                </div>
                <div class="form-group col-md-6">
                    <label for="lName">Last Name</label>
                    <input type="text" name="lName" class="form-control" id="lName" placeholder="Last Name">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3 mx-auto">
                    <label for="dob">Date of Birth</label>
                    <input class="form-control" type="text" name="dob" id="dob"  placeholder="MM/DD/YYYY">
                </div>
                <div class="form-group col-md-3 mx-auto">
                    <label for="npi">NPI</label>
                    <input class="form-control" type="text" name="npi" id="npi">
                </div>
                <div class="form-group col-md-3 mx-auto">
                    <label for="ssn">Social Security Number</label>
                    <input class="form-control" type="text" name="ssn" id="ssn">
                </div>
                <div class="form-group col-md-3">
                    <label for="cred">Credentials</label>
                    <select name="cred" id="cred" class="form-control">
                        <option value="">SELECT...</option>
                        <option value="M.D.">M.D.</option>
                        <option value="D.O.">D.O.</option>
                        <option value="M.B.B.S.">M.B.B.S.</option>
                        <option value="R.N.">R.N.</option>
                        <option value="N.P.">N.P.</option>
                        <option value="A.R.N.P.">A.R.N.P.</option>
                        <option value="A.P.R.N.">A.P.R.N.</option>
                        <option value="C.N.M.">C.N.M.</option>
                        <option value="C.N.P.">C.N.P.</option>
                        <option value="C.R.N.A.">C.R.N.A.</option>
                        <option value="D.N.P.">D.N.P.</option>
                        <option value="L.P.N.">L.P.N.</option>
                        <option value="P.A.">P.A.</option>
                        <option value="P.A.-C.">P.A.-C.</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="spec">Primary Specialty</label>
                    <select name="spec" id="spec" class="form-control">
                        <option selected value="">Choose...</option>
                        @foreach($specialties as $val)
                            <option value="{{$val->description}}">{{$val->description}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="lang">Spoken Languages <span class="text-nuted text-italic">(ctl+click Select Multiple)</span> </label>
                    <select multiple name="lang[]" id="lang" class="form-control">
                        <option value="1" selected>English</option>
                        <option value="2">Spanish</option>
                        <option value="3">Creole</option>
                        <option value="4">Portuguese</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" name="inputAddress" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address 2</label>
                <input type="text" name="inputAddress2" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" name="inputCity" class="form-control" id="inputCity">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select name="inputState" id="inputState" class="form-control">
                        <option selected value="">Choose...</option>
                        @foreach($state as $val)
                            <option value="{{$val->id}}">{{$val->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" name="inputZip" class="form-control" id="inputZip">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                </div>
                <div class="form-group col-md-6">
                    <label for="phone1">Phone Number</label>
                    <input type="text" name="phone1" class="form-control" id="phone1" placeholder="Phone Number">
                </div>
            </div>
        <hr>
        @foreach($insuranceType as $insuranceTypeVal)
            <div class="row mb-4">
                <div class="col-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="{{$insuranceTypeVal['id']}}_Check" id="{{$insuranceTypeVal['id']}}_Check" value="1">
                        <label class="form-check-label" for="phpCheck">
                            {{$insuranceTypeVal['type_name']}}
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <label for="startDate{{$insuranceTypeVal['id']}}" class="form-label">Start Date</label>
                    <input class="form-control insTypestart" type="text" id="startDate{{$insuranceTypeVal['id']}}" name="startDate{{$insuranceTypeVal['id']}}">
                </div>
                <div class="col-4">
                    <label for="termDate{{$insuranceTypeVal['id']}}" class="form-label">Term Date</label>
                    <input class="form-control insTypeEnd" type="text" id="termDate{{$insuranceTypeVal['id']}}" name="termDate{{$insuranceTypeVal['id']}}">
                </div>
            </div>
                 <hr>
        @endforeach
                <div class="form-group">
                <label for="notes">Notes</label>
                <textarea name="notes" class="form-control" id="notes" rows="3"></textarea>
            </div>
            <hr>
            <button type="reset" class="btn btn-danger float-right m-1">Discard</button>
            <button type="submit" class="btn btn-success float-right m-1">Add</button>
        </form>
    </div>

@endsection
@section('pagecss')
<link rel="stylesheet" href="{{url('/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
@endsection
@section('pagescript')
<script>
    $('#main_header').html('Add Provider');
</script>

<script src="{{url('/js/jquery_validation/jquery.validate.js')}}"></script>
<script src="{{url('/js/jquery_validation/additional-methods.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('/js/provider.js')}}"></script>
@endsection
<b></b>