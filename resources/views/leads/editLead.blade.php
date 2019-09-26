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

        <form action="{{ route('lead.store') }}" method="POST" id="lead_form" name="lead_form">
            @csrf
            <input type="hidden" name="id" id="id" value="{{$lead_details->id}}">
            <input type="hidden" name="agent_id" id="agent_id" value="{{$lead_details->agent}}">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fName">First Name</label>
                    <input type="text" name="fName" class="form-control" id="fName" placeholder="First Name" value="{{$lead_details->fName}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="lName">Last Name</label>
                    <input type="text" name="lName" class="form-control" id="lName" placeholder="Last Name" value="{{$lead_details->lName}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-4">
                    <label for="dob">Date of Birth</label>
                    <input class="form-control" type="text" name="dob" id="dob" value="{{$lead_details->dob}}">
                </div>
                <div class="form-group col-sm-4">
                    <label for="lang">Preferred Language</label>
                    <select name="lang" id="lang" class="form-control">
                        <option value="1" {{$lead_details->lang == 1 ?'selected':''}}>English</option>
                        <option value="2" {{$lead_details->lang == 2 ?'selected':''}}>Spanish</option>
                        <option value="3" {{$lead_details->lang == 3 ?'selected':''}}>Creole</option>
                        <option value="4" {{$lead_details->lang == 4 ?'selected':''}}>Portuguese</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" name="inputAddress" class="form-control" id="inputAddress" placeholder="1234 Main St" value="{{$lead_details->inputAddress}}">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address 2</label>
                <input type="text" name="inputAddress2" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" value="{{$lead_details->inputAddress2}}">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" name="inputCity" class="form-control" id="inputCity" value="{{$lead_details->inputCity}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select name="inputState" id="inputState" class="form-control">
                        <option selected value="">Choose...</option>
                        <option value="1" {{isset($lead_details) && $lead_details->inputState  == 1 ?'selected':''}}>AL</option>
                        <option value="2" {{isset($lead_details) && $lead_details->inputState  == 2 ?'selected':''}}>AK</option>
                        <option value="3" {{isset($lead_details) && $lead_details->inputState  == 3 ?'selected':''}}>AZ</option>
                        <option value="4" {{isset($lead_details) && $lead_details->inputState  == 4 ?'selected':''}}>AR</option>
                        <option value="5" {{isset($lead_details) && $lead_details->inputState  == 5 ?'selected':''}}>CA</option>
                        <option value="6" {{isset($lead_details) && $lead_details->inputState  == 6 ?'selected':''}}>CO</option>
                        <option value="7" {{isset($lead_details) && $lead_details->inputState  == 7 ?'selected':''}}>CT</option>
                        <option value="8" {{isset($lead_details) && $lead_details->inputState  == 8 ?'selected':''}}>DE</option>
                        <option value="9" {{isset($lead_details) && $lead_details->inputState  == 9 ?'selected':''}}>DC</option>
                        <option value="10" {{isset($lead_details) && $lead_details->inputState  == 10 ?'selected':''}}>FL</option>
                        <option value="11" {{isset($lead_details) && $lead_details->inputState  == 11 ?'selected':''}}>GA</option>
                        <option value="12" {{isset($lead_details) && $lead_details->inputState  == 12 ?'selected':''}}>HI</option>
                        <option value="13" {{isset($lead_details) && $lead_details->inputState  == 13 ?'selected':''}}>ID</option>
                        <option value="14" {{isset($lead_details) && $lead_details->inputState  == 14 ?'selected':''}}>IL</option>
                        <option value="15" {{isset($lead_details) && $lead_details->inputState  == 15 ?'selected':''}}>IN</option>
                        <option value="16" {{isset($lead_details) && $lead_details->inputState  == 16 ?'selected':''}}>IA</option>
                        <option value="17" {{isset($lead_details) && $lead_details->inputState  == 17 ?'selected':''}}>KS</option>
                        <option value="18" {{isset($lead_details) && $lead_details->inputState  == 18 ?'selected':''}}>KY</option>
                        <option value="19" {{isset($lead_details) && $lead_details->inputState  == 19 ?'selected':''}}>LA</option>
                        <option value="20" {{isset($lead_details) && $lead_details->inputState  == 20 ?'selected':''}}>ME</option>
                        <option value="21" {{isset($lead_details) && $lead_details->inputState  == 21 ?'selected':''}}>MD</option>
                        <option value="22" {{isset($lead_details) && $lead_details->inputState  == 22 ?'selected':''}}>MA</option>
                        <option value="23" {{isset($lead_details) && $lead_details->inputState  == 23 ?'selected':''}}>MI</option>
                        <option value="24" {{isset($lead_details) && $lead_details->inputState  == 24 ?'selected':''}}>MN</option>
                        <option value="25" {{isset($lead_details) && $lead_details->inputState  == 25 ?'selected':''}}>MS</option>
                        <option value="26" {{isset($lead_details) && $lead_details->inputState  == 26 ?'selected':''}}>MO</option>
                        <option value="27" {{isset($lead_details) && $lead_details->inputState  == 27 ?'selected':''}}>MT</option>
                        <option value="28" {{isset($lead_details) && $lead_details->inputState  == 28 ?'selected':''}}>NE</option>
                        <option value="29" {{isset($lead_details) && $lead_details->inputState  == 29 ?'selected':''}}>NV</option>
                        <option value="30" {{isset($lead_details) && $lead_details->inputState  == 30?'selected':''}}>NH</option>
                        <option value="31" {{isset($lead_details) && $lead_details->inputState  == 31 ?'selected':''}}>NJ</option>
                        <option value="32" {{isset($lead_details) && $lead_details->inputState  == 32 ?'selected':''}}>NM</option>
                        <option value="33" {{isset($lead_details) && $lead_details->inputState  == 32 ?'selected':''}}>NY</option>
                        <option value="34" {{isset($lead_details) && $lead_details->inputState  == 34 ?'selected':''}}>NC</option>
                        <option value="35" {{isset($lead_details) && $lead_details->inputState  == 35 ?'selected':''}}>ND</option>
                        <option value="36" {{isset($lead_details) && $lead_details->inputState  == 36 ?'selected':''}}>OH</option>
                        <option value="37" {{isset($lead_details) && $lead_details->inputState  == 37 ?'selected':''}}>OK</option>
                        <option value="38" {{isset($lead_details) && $lead_details->inputState  == 38 ?'selected':''}}>OR</option>
                        <option value="39" {{isset($lead_details) && $lead_details->inputState  == 39 ?'selected':''}}>PA</option>
                        <option value="40" {{isset($lead_details) && $lead_details->inputState  == 40 ?'selected':''}}>RI</option>
                        <option value="41" {{isset($lead_details) && $lead_details->inputState  == 41 ?'selected':''}}>SC</option>
                        <option value="42" {{isset($lead_details) && $lead_details->inputState  == 42 ?'selected':''}}>SD</option>
                        <option value="43" {{isset($lead_details) && $lead_details->inputState  == 43?'selected':''}}>TN</option>
                        <option value="44" {{isset($lead_details) && $lead_details->inputState  == 44 ?'selected':''}}>TX</option>
                        <option value="45" {{isset($lead_details) && $lead_details->inputState  == 45 ?'selected':''}}>UT</option>
                        <option value="46" {{isset($lead_details) && $lead_details->inputState  == 46 ?'selected':''}}>VT</option>
                        <option value="47" {{isset($lead_details) && $lead_details->inputState  == 47 ?'selected':''}}>VA</option>
                        <option value="48" {{isset($lead_details) && $lead_details->inputState  == 48 ?'selected':''}}>WA</option>
                        <option value="49" {{isset($lead_details) && $lead_details->inputState  == 49 ?'selected':''}}>WV</option>
                        <option value="50" {{isset($lead_details) && $lead_details->inputState  == 50 ?'selected':''}}>WI</option>
                        <option value="51" {{isset($lead_details) && $lead_details->inputState  == 51 ?'selected':''}}>WY</option>
                        <option value="52" {{isset($lead_details) && $lead_details->inputState  == 52 ?'selected':''}}>AS</option>
                        <option value="53" {{isset($lead_details) && $lead_details->inputState  == 53 ?'selected':''}}>PR</option>
                        <option value="54" {{isset($lead_details) && $lead_details->inputState  == 54 ?'selected':''}}>VI</option>
                        <option value="55" {{isset($lead_details) && $lead_details->inputState  == 55 ?'selected':''}}>GU</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" name="inputZip" class="form-control" id="inputZip" value="{{$lead_details->inputZip}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{$lead_details->email}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="phone1">Phone Number</label>
                    <input type="text" name="phone1" class="form-control" id="phone1" placeholder="Phone Number" value="{{$lead_details->phone1}}">
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-6">
                    <div class="form-row">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="agreeOrDisagree" id="agree" value="1" {{$lead_details->agreeOrDisagree == 1 ?'checked':''}} >
                                <label class="form-check-label" for="agree">
                                    Agree
                                </label>
                            </div>
                            <div>
                                <p>I spoke to the patient and expressly asked if I have their permission to provide their name and phone number to an agent that will call them to discuss benefit options and patient confirmed.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="agreeOrDisagree" id="disagree" value="2" {{$lead_details->agreeOrDisagree == 2 ?'checked':''}}>
                                <label class="form-check-label" for="disagree">
                                    Do NOT Agree
                                </label>
                            </div>
                            <div>
                                <p>Patient opted out of receiving a call regarding health plan options.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="planType">Plan Type</label>
                            <select name="planType" class="custom-select">
                                <option value="0" {{$lead_details->planType == 0 ?'selected':''}}>Other - Not Humana</option>
                                <option value="1" {{$lead_details->planType == 1 ?'selected':''}}>Humana Commercial HMO/PPO</option>
                                <option value="2" {{$lead_details->planType == 2 ?'selected':''}}>Humana Medicare HMO/PPO</option>
                                <option value="3" {{$lead_details->planType == 3 ?'selected':''}}>Humana Medicaid</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pcpName">PCP Name</label>
                            <select name="pcpName" id="pcpName" class="form-control">
                                <option value="">Choose...</option>
                                @foreach($doctors as $doc)
                                <option value="{{$doc->id}}" {{$lead_details->pcpName == $doc->id ?'selected':''}}>{{$doc->first_name." ".$doc->last_name}}, {{$doc->type}}</option>
                                @endforeach
                                <option value="0" {{$lead_details->pcpName == 0 ?'selected':''}}>Other..See Notes...</option>
                            </select>
                        </div>
                        <div class="form-group">
                                <label for="pcpName">Agent</label>
                                <select name="agent" id="agent" class="form-control">
                                    <option value="">Choose...</option>
                                </select>
                            </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea name="notes" class="form-control" id="notes" rows="3">{{$lead_details->notes}}</textarea>
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
