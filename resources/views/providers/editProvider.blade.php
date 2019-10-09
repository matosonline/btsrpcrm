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

        <form action="{{ route('provider.store') }}" method="POST" id="edit_provider_form" name="edit_provider_form">
            @csrf
            <input type="hidden" name="id" id="id" value="{{$doctors_details->id}}">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fName">First Name</label>
                    <input type="text" name="fName" class="form-control" id="fName" placeholder="First Name" value="{{$doctors_details->first_name}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="lName">Last Name</label>
                    <input type="text" name="lName" class="form-control" id="lName" placeholder="Last Name" value="{{$doctors_details->last_name}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3 mx-auto">
                    <label for="dob">Date of Birth</label>
                    <input class="form-control" type="text" name="dob" id="dob" value="{{$doctors_details->dob}}"  placeholder="MM/DD/YYYY">
                </div>
                <div class="form-group col-md-3 mx-auto">
                    <label for="npi">NPI</label>
                    <input class="form-control" type="text" name="npi" id="npi" value="{{$doctors_details->npi}}">
                </div>
                <div class="form-group col-md-3 mx-auto">
                    <label for="ssn">Social Security Number</label>
                    <input class="form-control" type="text" name="ssn" id="ssn" value="{{$doctors_details->ssn}}"> 
                </div>
                <div class="form-group col-md-3">
                    <label for="cred">Credentials</label>
                    <select name="cred" id="cred" class="form-control">
                        <option value="">SELECT...</option>
                        <option value="MD" {{$doctors_details->type == "MD"?'selected':''}}>M.D.</option>
                        <option value="DO" {{$doctors_details->type == "DO"?'selected':''}}>D.O.</option>
                        <option value="MBBS" {{$doctors_details->type == "MBBS"?'selected':''}}>M.B.B.S.</option>
                        <option value="RN" {{$doctors_details->type == "RN"?'selected':''}}>R.N.</option>
                        <option value="NP" {{$doctors_details->type == "NP"?'selected':''}}>N.P.</option>
                        <option value="ARNP" {{$doctors_details->type == "ARNP"?'selected':''}}>A.R.N.P.</option>
                        <option value="APRN" {{$doctors_details->type == "APRN"?'selected':''}}>A.P.R.N.</option>
                        <option value="CNM" {{$doctors_details->type == "CNM"?'selected':''}}>C.N.M.</option>
                        <option value="CNP" {{$doctors_details->type == "CNP"?'selected':''}}>C.N.P.</option>
                        <option value="CRNA" {{$doctors_details->type == "CRNA"?'selected':''}}>C.R.N.A.</option>
                        <option value="DNP" {{$doctors_details->type == "DNP"?'selected':''}}>D.N.P.</option>
                        <option value="LPN" {{$doctors_details->type == "LPN"?'selected':''}}>L.P.N.</option>
                        <option value="PA" {{$doctors_details->type == "PA"?'selected':''}}>P.A.</option>
                        <option value="PAC" {{$doctors_details->type == "PAC"?'selected':''}}>P.A.-C.</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="spec">Primary Specialty</label>
                    <select name="spec" id="spec" class="form-control">
                        <option selected value="">Choose...</option>
                        @foreach($specialties as $val)
                            <option value="{{$val->description}}" {{ucwords($doctors_details->primary_speciality) == ucwords($val->description)?'selected':''}}>{{$val->description}}</option>
                        @endforeach
                    </select>
                </div>
                @php 
                    $lang = array();
                    if($doctors_details->lang != ''){
                        $lang = unserialize($doctors_details->lang);
                    }
                @endphp
                <div class="form-group col-md-6">
                    <label for="lang">Spoken Languages <span class="text-nuted text-italic">(ctl+click Select Multiple)</span> </label>
                    <select multiple name="lang[]" id="lang" class="form-control">
                        <option value="1" {{in_array(1,$lang)?'selected':''}}>English</option>
                        <option value="2" {{in_array(2,$lang)?'selected':''}}>Spanish</option>
                        <option value="3" {{in_array(3,$lang)?'selected':''}}>Creole</option>
                        <option value="4" {{in_array(4,$lang)?'selected':''}}>Portuguese</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" name="inputAddress" class="form-control" id="inputAddress" placeholder="1234 Main St" value="{{$doctors_details->address1}}">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address 2</label>
                <input type="text" name="inputAddress2" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" value="{{$doctors_details->inputAddress2}}">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" name="inputCity" class="form-control" id="inputCity" value="{{$doctors_details->inputCity}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select name="inputState" id="inputState" class="form-control">
                        <option selected value="">Choose...</option>
                        @foreach($state as $val)
                            <option value="{{$val->id}}" {{$doctors_details->inputState == $val->id ? 'selected':''}}>{{$val->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" name="inputZip" class="form-control" id="inputZip"  value="{{$doctors_details->inputZip}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email"   value="{{$doctors_details->email}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="phone1">Phone Number</label>
                    <input type="text" name="phone1" class="form-control" id="phone1" placeholder="Phone Number"   value="{{$doctors_details->phone1}}">
                </div>
            </div>
        <hr>
        @php  
            $doctoreType = array();
            foreach($doctors_details['doctorInsuranceType'] as $key => $val){
                $doctoreType[$val['insurance_type_id']][] = $val['start_date'];
                $doctoreType[$val['insurance_type_id']][] = $val['end_date'];
            }
        @endphp
        <?php // echo "<pre>";print_r($doctoreType);exit;?>
        @foreach($insuranceType as $insuranceTypeVal)
            <div class="row mb-4">
                <div class="col-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="{{$insuranceTypeVal['id']}}_Check" id="{{$insuranceTypeVal['id']}}_Check" 
                               value="{{array_key_exists($insuranceTypeVal['id'],$doctoreType)?'1':''}}" {{array_key_exists($insuranceTypeVal['id'],$doctoreType)?'checked':''}}>
                        <label class="form-check-label" for="phpCheck">
                            {{$insuranceTypeVal['type_name']}}
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <label for="startDate{{$insuranceTypeVal['id']}}" class="form-label">Start Date</label>
                    <input class="form-control insTypestart" type="text" id="startDate{{$insuranceTypeVal['id']}}" name="startDate{{$insuranceTypeVal['id']}}" 
                           value="{{array_key_exists($insuranceTypeVal['id'],$doctoreType)?$doctoreType[$insuranceTypeVal['id']][0]:''}}">
                </div>
                <div class="col-4">
                    <label for="termDate{{$insuranceTypeVal['id']}}" class="form-label">Term Date</label>
                    <input class="form-control insTypeEnd" type="text" id="termDate{{$insuranceTypeVal['id']}}" name="termDate{{$insuranceTypeVal['id']}}"
                           value="{{array_key_exists($insuranceTypeVal['id'],$doctoreType)?$doctoreType[$insuranceTypeVal['id']][1]:''}}">
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
    $('#main_header').html('Edit Provider');
</script>

<script src="{{url('/js/jquery_validation/jquery.validate.js')}}"></script>
<script src="{{url('/js/jquery_validation/additional-methods.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('/js/provider.js')}}"></script>
@endsection
<b></b>