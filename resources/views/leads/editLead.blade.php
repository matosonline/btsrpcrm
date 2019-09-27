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
                        @foreach($state as $val)
                            <option value="{{$val->id}}" {{$val->id == $lead_details->inputState ?'selected':''}}>{{$val->name}}</option>
                        @endforeach
                       
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
