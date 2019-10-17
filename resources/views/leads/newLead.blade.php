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
<div class="newLeadForm">  
    <form action="{{ route('lead.store') }}" method="POST" id="lead_form" name="lead_form" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header"></div>
                        <div class="card-body">
                               
                                <div class="form-row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="fName">First Name</label>
                                        <input type="text" name="fName" class="form-control" id="fName" placeholder="First Name" value="{{$getProspectData?$getProspectData->PatientFirstName:''}}">
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="lName">Last Name</label>
                                        <input type="text" name="lName" class="form-control" id="lName" placeholder="Last Name" value="{{$getProspectData?$getProspectData->PatientLastName:' '}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="dob">Date of Birth</label>
                                        <input class="form-control" type="text" name="dob" id="dob"  placeholder="MM/DD/YYYY" value="{{$getProspectData?$getProspectData->DOB:''}}">
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="lang">Preferred Language</label>
                                        <select name="lang" id="lang" class="form-control">
                                            <option value="1">English</option>
                                            <option value="2">Spanish</option>
                                            <option value="3">Creole</option>
                                            <option value="4">Portuguese</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-md-6">

                                        <label for="inputAddress">Address</label>
                                        <input type="text" name="inputAddress" class="form-control" id="inputAddress" placeholder="1234 Main St" value="{{$getProspectData?$getProspectData->AddressLine1:''}}">
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="inputAddress2">Address 2</label>
                                        <input type="text" name="inputAddress2" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" value="{{$getProspectData?$getProspectData->AddressLine2:''}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-sm-4">
                                        <label for="inputCity">City</label>
                                        <input type="text" name="inputCity" class="form-control" id="inputCity" value="{{$getProspectData?$getProspectData->City:''}}">
                                    </div>
                                    <div class="form-group col-12 col-sm-4">
                                        <label for="inputState">State</label>
                                        <select name="inputState" id="inputState" class="form-control">
                                            <option selected value="">Choose...</option>
                                            @foreach($state as $val)
                                                <option value="{{$val->id}}" {{$getProspectData && $getProspectData->State ==  $val->id?'selected':''}}>{{$val->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-sm-4">
                                        <label for="inputZip">Zip</label>
                                        <input type="text" name="inputZip" class="form-control" id="inputZip" value="{{$getProspectData?$getProspectData->Zip:''}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="phone1">Phone Number</label>
                                        <input type="text" class="form-control bfh-phone" name="phone1" id="phone1" data-format="(ddd) ddd-dddd" placeholder="Phone Number">
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer"></div>
                </div>
            </div>
            <div class="col-md-5">
            <div class="accordion" id="editLeadAccordion">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Health Plan / PCP</h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#editLeadAccordion">
                        <div class="card-body">
                             <div class="form-row">
                                 <div class="form-group col-12 col-sm-6">
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="agreeOrDisagree" id="agree" value="1" checked>
                                        <label class="form-check-label" for="agree">
                                            Agree
                                        </label>
                                    </div>
                                    <div>
                                        <p>I spoke to the patient and expressly asked if I have their permission to provide their name and phone number to an agent that will call them to discuss benefit options and patient confirmed.</p>
                                    </div>
                                 </div>
                                 <div class="form-group col-12 col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="agreeOrDisagree" id="disagree" value="2">
                                        <label class="form-check-label" for="disagree">
                                            Do NOT Agree
                                        </label>
                                    </div>
                                    <div>
                                        <p>Patient opted out of receiving a call regarding health plan options.</p>
                                    </div>
                                 </div>
                             </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-6">
                                    <label for="healthPlan">Health Plan</label>
                                    <select name="planType" class="custom-select" id="planType">
                                        <option value="0" default>Medicare Advantage</option>
                                        <option value="1">Medicaid</option>
                                        <option value="2">Commercial</option>
                                        <option value="3">Medicare FFS</option>
                                        <option value="4">Aging-In</option>
                                        <option value="5">Humana</option>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="planTypeDetail">Detail</label>
                                    <input type="text" name="planTypeDetail" class="form-control" id="planTypeDetail">
                                </div>
                           </div>
                            <div class="form-row type_option" style="display: none">
                                <div class="form-group col-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="inquire_type" id="inquireNo" value="1">
                                            <label class="form-check-label" for="inquireNo">Stay with current PCP</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-check">
                                                <input class="form-check-input" type="radio" name="inquire_type" id="inquireYes" value="2" checked>
                                            <label class="form-check-label" for="inquireYes">New MSMC PCP</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="pcpName">Primary Care Provider</label>
                                    <select name="pcpName" id="pcpName" class="form-control">
                                        <option value="">Choose...</option>
                                        @foreach($doctors as $doc)
                                            <option value="{{$doc->id}}">{{$doc->first_name." ".$doc->last_name}}, {{$doc->type}} - {{$doc->location_nm}}</option>
                                        @endforeach
                                        <option value="0">Other..See Notes...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row pcp_other_textbox">
                                <div class="form-group col-12 col-md-6">
                                    <input type="text" class="form-control" name="pcp_other" id="pcp_other" placeholder="Other" style="display:none">
                                </div>
                            </div>
                            <div class="form-row">
                                
                                <div class="form-group col-12 col-md-6">
                                    <label for="pcpName">Agent</label>
                                    <select name="agent" id="agent" class="form-control">
                                        <option value="">Choose...</option>
                                    </select>
                                </div>
                            </div>
                            <!--<div class="form-row">
                                <div class="form-group col-12 col-sm-6">
                                    <label for="lStatus">Lead Status</label>
                                    <select name="lStatus" id="lStatus" class="form-control">
                                        <option value="1" {{-- isset($lead_details)&& $lead_details['lStatus'] == 1?'selected':''}} --}}>New</option>
                                        <option value="2" {{-- isset($lead_details)&& $lead_details['lStatus'] == 2?'selected':''}} --}}>Pending</option>
                                        <option value="5" {{-- isset($lead_details)&& $lead_details['lStatus'] == 5?'selected':''}} --}}>Pending <span class="test-success text-italic">Appointment Scheduled</span></option>
                                        <option value="3" {{-- isset($lead_details)&& $lead_details['lStatus'] == 3?'selected':''}} --}}>Closed <span class="test-success text-italic">Success</span></option>
                                        <option value="4" {{-- isset($lead_details)&& $lead_details['lStatus'] == 4?'selected':''}} --}}>Lost <span class="test-danger text-italic">Failure</span></option>
                                    </select>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Notes</h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#editLeadAccordion">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-12">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="notes">Notes</label>
                                    <textarea name="notes" class="form-control" id="notes" rows="3">{{$getProspectData?$getProspectData->Notes:''}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Attachments</h5>
                    </div>
                   <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#editLeadAccordion">
                        <div class="card-body">
                            <div class="form-group col-12 col-sm-12">
                                    <label for="uploadDocs">Upload Files</label>
                                    <input type="file" name="uploadDocs[]" class="form-control-file" id="uploadDocs" multiple>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-group d-flex" role="group">
                <button type="reset" class="btn btn-lg btn-danger m-1">Dismiss</button>
                <button type="submit" class="btn btn-lg btn-success m-1">Add</button> 
            </div>
        </div>
        </div>
    </form>
</div>
@endsection
@section('pagecss')
<link rel="stylesheet" href="{{url('/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" href="{{url('/css/select2.min.css')}}">
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
<script src="{{url('/js/select2.min.js')}}"></script>
<script src="{{url('/js/lead.js')}}"></script>
@endsection
<b></b>
