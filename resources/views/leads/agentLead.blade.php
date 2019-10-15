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
<div class="editLeadForm">
    <form action="{{ route('lead.store') }}" method="POST" id="lead_edit_form" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    <input type="hidden" name="id" id='id' value="{{isset($lead_details)?$lead_details['id']:''}}">
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label for="agentChoose">Agent</label>
                            <select name="agent" id="agentEdit" class="form-control">
                                <option selected value="">Unassigned</option>
                                @if($agent_details)
                                    @foreach($agent_details as $key => $val)
                                        <option value="{{$val['id']}}" {{isset($lead_details)&& $lead_details['agent'] == $val['id']?'selected':''}}>{{$val['first_name'].' '.$val['last_name']}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label for="fName">First Name</label>
                            <input type="text" name="fName" class="form-control" id="fName" placeholder="First Name" value="{{isset($lead_details)?$lead_details['fName']:''}}">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="lName">Last Name</label>
                            <input type="text" name="lName" class="form-control" id="lName" placeholder="Last Name" value="{{isset($lead_details)?$lead_details['lName']:''}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-4 mx-auto">
                            <label for="dob">Date of Birth</label>
                            <input class="form-control" type="text" name="dob" id="dob" value="{{isset($lead_details)?$lead_details['dob']:''}}" placeholder="MM/DD/YYYY">
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
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <label for="inputAddress">Address</label>
                            <input type="text" name="inputAddress" class="form-control" id="inputAddress" placeholder="1234 Main St" value="{{isset($lead_details)?$lead_details['inputAddress']:''}}">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="inputAddress2">Address 2</label>
                            <input type="text" name="inputAddress2" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" value="{{isset($lead_details)?$lead_details['inputAddress2']:''}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-sm-4">
                            <label for="inputCity">City</label>
                            <input type="text" name="inputCity" class="form-control" id="inputCity" value="{{isset($lead_details)?$lead_details['inputCity']:''}}">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="inputState">State</label>
                            <select name="inputState" id="inputState" class="form-control">
                                <option selected value="">Choose...</option>
                                @foreach($state as $val)
                                    <option value="{{$val->id}}" {{$val->id == $lead_details->inputState ?'selected':''}}>{{$val->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="inputZip">Zip</label>
                            <input type="text" name="inputZip" class="form-control" id="inputZip"  value="{{isset($lead_details)?$lead_details['inputZip']:''}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-sm-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email"   value="{{isset($lead_details)?$lead_details['email']:''}}">
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <label for="phone1">Phone Number</label>
                            <input type="text" name="phone1" class="form-control" id="phone1" placeholder="Phone Number"   value="{{isset($lead_details)?$lead_details['phone1']:''}}">
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
                                    <label for="healthPlan">Health Plan</label>
                                    <select name="healthPlan" id="healthPlan" class="form-control">
                                        <option selected value="">Choose...</option>
                                        <option value="1"  {{isset($lead_details)&& $lead_details['healthPlan'] == 1?'selected':''}}>Simply</option>
                                        <option value="2" {{isset($lead_details)&& $lead_details['healthPlan'] == 2?'selected':''}}>CarePlus</option>
                                        <option value="3" {{isset($lead_details)&& $lead_details['healthPlan'] == 3?'selected':''}}>Medica</option>
                                        <option value="4" {{isset($lead_details)&& $lead_details['healthPlan'] == 4?'selected':''}}>PCP</option>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <label for="startDate">Start Date</label>
                                    <input class="form-control" type="test" name="startDate" id="startDate"  value="{{isset($lead_details)?$lead_details['startDate']:''}}"  placeholder="MM/DD/YYYY">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="pcp">Primary Care Provider</label>
                                    <select name="pcpName" id="pcpName" class="form-control">
                                        <option selected value="">Choose...</option>
                                        @if($doctors)
                                            @foreach($doctors as $key => $val)
                                                <option value="{{$val['id']}}" {{isset($lead_details)&& $lead_details['pcpName'] == $val['id'] ?'selected':''}}>{{$val['first_name'].' '.$val['last_name']}}, {{$val['type']}}</option>
                                            @endforeach
                                        @endif
                                        <option value="0">Other..See Notes...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-6">
                                    <label for="lStatus">Lead Status</label>
                                    <select name="lStatus" id="lStatus" class="form-control">
                                        <option value="1" {{isset($lead_details)&& $lead_details['lStatus'] == 1?'selected':''}}>New</option>
                                        <option value="2" {{isset($lead_details)&& $lead_details['lStatus'] == 2?'selected':''}}>Pending</option>
                                        <option value="5" {{isset($lead_details)&& $lead_details['lStatus'] == 5?'selected':''}}>Pending <span class="test-danger text-italic">Appointment Scheduled</span></option>
                                        <option value="3" {{isset($lead_details)&& $lead_details['lStatus'] == 3?'selected':''}}>Closed <span class="test-success text-italic">Success</span></option>
                                        <option value="4" {{isset($lead_details)&& $lead_details['lStatus'] == 4?'selected':''}}>Lost <span class="test-danger text-italic">Failure</span></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Notes</h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#editLeadAccordion">
                        <div class="card-body">
                            @if(!$notes->isempty())
                            <div class="form-row">
                                <div class="form-group col-12 editLeadNoteSec">
                                    @foreach($notes as $val)
                                            <div class="mb-2">
                                                <span class="small text-muted">{{$val['note_date']}} - {{$val['first_name'].' '.$val['last_name']}}: </span> {{$val['notes']}}
                                            </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="notes">Notes</label>
                                    <textarea name="notes" class="form-control" id="notes" rows="3"></textarea>
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
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-6">
                                    <label for="uploadDocs">Upload Files</label>
                                    <input type="file" name="uploadDocs[]" class="form-control-file" id="uploadDocs" multiple>
                                </div>
                            </div>
                            @if(!$getAttachment->isempty())
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                            <tr>
                                                <th>FileName</th>
                                                <th>Action</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($getAttachment as $val)
                                        <tr class="attach_row" id="attach_{{$val->id}}">
                                            <td><a href="{{ url('/storage/app/leadDoc/'.$val->filename)}}" target="_blank"><span data-feather="file"></span>{{substr($val->filename, strpos($val->filename, "]") + 1)}}</td></a>
                                            <td><span data-feather="trash-2" class="danger_color attach_delete" data-attach="{{$val->id}}"></span></td>
                                        </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-group d-flex" role="group">
                <button type="reset" class="btn btn-lg btn-danger m-1">Dismiss</button> <!-- must validate "Are you sure this patient has declined / must correspond with correct selection" -->
                <button type="submit" class="btn btn-lg btn-success m-1">Update</button> <!-- must correspond with corrent selection above -->
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
    $('#main_header').html('Edit Lead');
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
