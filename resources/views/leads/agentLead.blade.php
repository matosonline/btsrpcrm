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

        <form action="{{ route('lead.store') }}" method="POST" id="lead_edit_form">
            @csrf
            <input type="hidden" name="id" id='id' value="{{isset($lead_details)?$lead_details['lead_id']:''}}">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="agentChoose">Agent</label>
                    <select name="agentChoose" id="agentChoose" class="form-control">
                        <option selected value="">Unassigned</option>
                        @if($agent_details)
                            @foreach($agent_details as $key => $val)
                                <option value="{{$val['id']}}" {{isset($lead_details)&& $lead_details['agentChoose'] == $key?'selected':''}}>{{$val['first_name'].' '.$val['last_name']}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        <hr>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fName">First Name</label>
                    <input type="text" name="fName" class="form-control" id="fName" placeholder="First Name" value="{{isset($lead_details)?$lead_details['fName']:''}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="lName">Last Name</label>
                    <input type="text" name="lName" class="form-control" id="lName" placeholder="Last Name" value="{{isset($lead_details)?$lead_details['lName']:''}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-4 mx-auto">
                    <label for="dob">Date of Birth</label>
                    <input class="form-control" type="date" name="dob" id="dob" value="{{isset($lead_details)?$lead_details['dob']:''}}">
                </div>
                <div class="form-group col-sm-4 mx-auto">
                    <label for="lang">Preferred Language</label>
                    <select name="lang" id="lang" class="form-control">
                        <option value="1" {{isset($lead_details) && $lead_details['lang'] == 1 ?'selected':''}} >English</option>
                        <option value="2" {{isset($lead_details) && $lead_details['lang'] == 2 ?'selected':''}} >Spanish</option>
                        <option value="3" {{isset($lead_details) && $lead_details['lang'] == 3 ?'selected':''}} >Creole</option>
                        <option value="4" {{isset($lead_details) && $lead_details['lang'] == 4 ?'selected':''}} >Portuguese</option>
                    </select>
                </div>
                <div class="form-group col-sm-4 mx-auto">
                    <label for="careID">Medicare ID#</label>
                    <input class="form-control" type="text" name="careID" id="careID" value="{{isset($lead_details)?$lead_details['careID']:''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" name="inputAddress" class="form-control" id="inputAddress" placeholder="1234 Main St" value="{{isset($lead_details)?$lead_details['inputAddress']:''}}">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address 2</label>
                <input type="text" name="inputAddress2" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" value="{{isset($lead_details)?$lead_details['inputAddress2']:''}}">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" name="inputCity" class="form-control" id="inputCity" value="{{isset($lead_details)?$lead_details['inputCity']:''}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select name="inputState" id="inputState" class="form-control">
                        <option selected value="">Choose...</option>
                        <option value="1" {{isset($lead_details) && $lead_details['inputState'] == 1 ?'selected':''}}>AL</option>
                        <option value="2" {{isset($lead_details) && $lead_details['inputState'] == 2 ?'selected':''}}>AK</option>
                        <option value="3" {{isset($lead_details) && $lead_details['inputState'] == 3 ?'selected':''}}>AZ</option>
                        <option value="4" {{isset($lead_details) && $lead_details['inputState'] == 4 ?'selected':''}}>AR</option>
                        <option value="5" {{isset($lead_details) && $lead_details['inputState'] == 5 ?'selected':''}}>CA</option>
                        <option value="6" {{isset($lead_details) && $lead_details['inputState'] == 6 ?'selected':''}}>CO</option>
                        <option value="7" {{isset($lead_details) && $lead_details['inputState'] == 7 ?'selected':''}}>CT</option>
                        <option value="8" {{isset($lead_details) && $lead_details['inputState'] == 8 ?'selected':''}}>DE</option>
                        <option value="9" {{isset($lead_details) && $lead_details['inputState'] == 9 ?'selected':''}}>DC</option>
                        <option value="10" {{isset($lead_details) && $lead_details['inputState'] == 10 ?'selected':''}}>FL</option>
                        <option value="11" {{isset($lead_details) && $lead_details['inputState'] == 11 ?'selected':''}}>GA</option>
                        <option value="12" {{isset($lead_details) && $lead_details['inputState'] == 12 ?'selected':''}}>HI</option>
                        <option value="13" {{isset($lead_details) && $lead_details['inputState'] == 13 ?'selected':''}}>ID</option>
                        <option value="14" {{isset($lead_details) && $lead_details['inputState'] == 14 ?'selected':''}}>IL</option>
                        <option value="15" {{isset($lead_details) && $lead_details['inputState'] == 15 ?'selected':''}}>IN</option>
                        <option value="16" {{isset($lead_details) && $lead_details['inputState'] == 16 ?'selected':''}}>IA</option>
                        <option value="17" {{isset($lead_details) && $lead_details['inputState'] == 17 ?'selected':''}}>KS</option>
                        <option value="18" {{isset($lead_details) && $lead_details['inputState'] == 18 ?'selected':''}}>KY</option>
                        <option value="19" {{isset($lead_details) && $lead_details['inputState'] == 19 ?'selected':''}}>LA</option>
                        <option value="20" {{isset($lead_details) && $lead_details['inputState'] == 20 ?'selected':''}}>ME</option>
                        <option value="21" {{isset($lead_details) && $lead_details['inputState'] == 21 ?'selected':''}}>MD</option>
                        <option value="22" {{isset($lead_details) && $lead_details['inputState'] == 22 ?'selected':''}}>MA</option>
                        <option value="23" {{isset($lead_details) && $lead_details['inputState'] == 23 ?'selected':''}}>MI</option>
                        <option value="24" {{isset($lead_details) && $lead_details['inputState'] == 24 ?'selected':''}}>MN</option>
                        <option value="25" {{isset($lead_details) && $lead_details['inputState'] == 25 ?'selected':''}}>MS</option>
                        <option value="26" {{isset($lead_details) && $lead_details['inputState'] == 26 ?'selected':''}}>MO</option>
                        <option value="27" {{isset($lead_details) && $lead_details['inputState'] == 27 ?'selected':''}}>MT</option>
                        <option value="28" {{isset($lead_details) && $lead_details['inputState'] == 28 ?'selected':''}}>NE</option>
                        <option value="29" {{isset($lead_details) && $lead_details['inputState'] == 29 ?'selected':''}}>NV</option>
                        <option value="30" {{isset($lead_details) && $lead_details['inputState'] == 30?'selected':''}}>NH</option>
                        <option value="31" {{isset($lead_details) && $lead_details['inputState'] == 31 ?'selected':''}}>NJ</option>
                        <option value="32" {{isset($lead_details) && $lead_details['inputState'] == 32 ?'selected':''}}>NM</option>
                        <option value="33" {{isset($lead_details) && $lead_details['inputState'] == 32 ?'selected':''}}>NY</option>
                        <option value="34" {{isset($lead_details) && $lead_details['inputState'] == 34 ?'selected':''}}>NC</option>
                        <option value="35" {{isset($lead_details) && $lead_details['inputState'] == 35 ?'selected':''}}>ND</option>
                        <option value="36" {{isset($lead_details) && $lead_details['inputState'] == 36 ?'selected':''}}>OH</option>
                        <option value="37" {{isset($lead_details) && $lead_details['inputState'] == 37 ?'selected':''}}>OK</option>
                        <option value="38" {{isset($lead_details) && $lead_details['inputState'] == 38 ?'selected':''}}>OR</option>
                        <option value="39" {{isset($lead_details) && $lead_details['inputState'] == 39 ?'selected':''}}>PA</option>
                        <option value="40" {{isset($lead_details) && $lead_details['inputState'] == 40 ?'selected':''}}>RI</option>
                        <option value="41" {{isset($lead_details) && $lead_details['inputState'] == 41 ?'selected':''}}>SC</option>
                        <option value="42" {{isset($lead_details) && $lead_details['inputState'] == 42 ?'selected':''}}>SD</option>
                        <option value="43" {{isset($lead_details) && $lead_details['inputState'] == 43?'selected':''}}>TN</option>
                        <option value="44" {{isset($lead_details) && $lead_details['inputState'] == 44 ?'selected':''}}>TX</option>
                        <option value="45" {{isset($lead_details) && $lead_details['inputState'] == 45 ?'selected':''}}>UT</option>
                        <option value="46" {{isset($lead_details) && $lead_details['inputState'] == 46 ?'selected':''}}>VT</option>
                        <option value="47" {{isset($lead_details) && $lead_details['inputState'] == 47 ?'selected':''}}>VA</option>
                        <option value="48" {{isset($lead_details) && $lead_details['inputState'] == 48 ?'selected':''}}>WA</option>
                        <option value="49" {{isset($lead_details) && $lead_details['inputState'] == 49 ?'selected':''}}>WV</option>
                        <option value="50" {{isset($lead_details) && $lead_details['inputState'] == 50 ?'selected':''}}>WI</option>
                        <option value="51" {{isset($lead_details) && $lead_details['inputState'] == 51 ?'selected':''}}>WY</option>
                        <option value="52" {{isset($lead_details) && $lead_details['inputState'] == 52 ?'selected':''}}>AS</option>
                        <option value="53" {{isset($lead_details) && $lead_details['inputState'] == 53 ?'selected':''}}>PR</option>
                        <option value="54" {{isset($lead_details) && $lead_details['inputState'] == 54 ?'selected':''}}>VI</option>
                        <option value="55" {{isset($lead_details) && $lead_details['inputState'] == 55 ?'selected':''}}>GU</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" name="inputZip" class="form-control" id="inputZip"  value="{{isset($lead_details)?$lead_details['inputZip']:''}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email"   value="{{isset($lead_details)?$lead_details['email']:''}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="phone1">Phone Number</label>
                    <input type="text" name="phone1" class="form-control" id="phone1" placeholder="Phone Number"   value="{{isset($lead_details)?$lead_details['phone1']:''}}">
                </div>
            </div>

        <hr>

            <div class="row">
                <div class="col-6">
                    <div class="for-row">
                        <div class="form-group">
                            <label for="healthPlan">Health Plan</label>
                            <select name="healthPlan" id="healthPlan" class="form-control">
                                <option selected value="">Choose...</option>
                                <option value="1"  {{isset($lead_details)&& $lead_details['healthPlan'] == 1?'selected':''}}>Simply</option>
                                <option value="2" {{isset($lead_details)&& $lead_details['healthPlan'] == 2?'selected':''}}>CarePlus</option>
                                <option value="3" {{isset($lead_details)&& $lead_details['healthPlan'] == 3?'selected':''}}>Medica</option>
                                <option value="4" {{isset($lead_details)&& $lead_details['healthPlan'] == 4?'selected':''}}>PCP</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group mx-auto">
                        <label for="startDate">Start Date</label>
                        <input class="form-control" type="date" name="startDate" id="startDate"  value="{{isset($lead_details)?$lead_details['startDate']:''}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="pcp">Primary Care Provider</label>
                    <select name="pcpName" id="pcpName" class="form-control">
                        <option selected value="">Choose...</option>
                        @if($doctors)
                            @foreach($doctors as $key => $val)
                                <option value="{{$val['id']}}" {{isset($lead_details)&& $lead_details['pcpName'] == $val['id'] ?'selected':''}}>{{$val['first_name'].' '.$val['last_name']}}, {{$val['type']}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group mt-4">
                <label for="notes">Notes</label>
                <textarea name="notes" class="form-control" id="notes" rows="3">{{isset($lead_details)?$lead_details['notes']:''}}</textarea>
            </div>
        <hr>
            <div class="row">
                <div class="col-6">
                    <label for="lStatus">Lead Status</label>
                    <select name="lStatus" id="lStatus" class="form-control">
                        <option value="1" {{isset($lead_details)&& $lead_details['lStatus'] == 1?'selected':''}}>New</option>
                        <option value="2" {{isset($lead_details)&& $lead_details['lStatus'] == 2?'selected':''}}>Pending</option>
                        <option value="3" {{isset($lead_details)&& $lead_details['lStatus'] == 3?'selected':''}}>Closed <span class="test-success text-italic">Success</span></option>
                        <option value="4" {{isset($lead_details)&& $lead_details['lStatus'] == 4?'selected':''}}>Lost <span class="test-danger text-italic">Failure</span></option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="uploadDocs">Upload Files</label>
                    <input type="file" name="uploadDocs" class="form-control-file" id="uploadDocs">
                </div>
            </div>
        <hr>
            <div class="btn-group d-flex" role="group">
                <button type="reset" class="btn btn-lg btn-danger m-1">Dismiss</button> <!-- must validate "Are you sure this patient has declined / must correspond with correct selection" -->
                <button type="submit" class="btn btn-lg btn-success m-1">Update</button> <!-- must correspond with corrent selection above -->
            </div>

        </form>
    </div>

@endsection
@section('pagecss')
<link rel="stylesheet" href="{{url('/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
@endsection
@section('pagescript')
<script>
    $('#main_header').html('Add Lead');
</script>

<script src="{{url('/js/jquery_validation/jquery.validate.js')}}"></script>
<script src="{{url('/js/jquery_validation/additional-methods.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('/js/lead.js')}}"></script>
@endsection
<b></b>