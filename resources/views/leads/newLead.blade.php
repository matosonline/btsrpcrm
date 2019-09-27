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
                <div class="form-group col-sm-4">
                    <label for="dob">Date of Birth</label>
                    <input class="form-control" type="text" name="dob" id="dob">
                </div>
                <div class="form-group col-sm-4">
                    <label for="lang">Preferred Language</label>
                    <select name="lang" id="lang" class="form-control">
                        <option value="1">English</option>
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
                        <option value="1">AL</option>
                        <option value="2">AK</option>
                        <option value="3">AZ</option>
                        <option value="4">AR</option>
                        <option value="5">CA</option>
                        <option value="6">CO</option>
                        <option value="7">CT</option>
                        <option value="8">DE</option>
                        <option value="9">DC</option>
                        <option value="10">FL</option>
                        <option value="11">GA</option>
                        <option value="12">HI</option>
                        <option value="13">ID</option>
                        <option value="14">IL</option>
                        <option value="15">IN</option>
                        <option value="16">IA</option>
                        <option value="17">KS</option>
                        <option value="18">KY</option>
                        <option value="19">LA</option>
                        <option value="20">ME</option>
                        <option value="21">MD</option>
                        <option value="22">MA</option>
                        <option value="23">MI</option>
                        <option value="24">MN</option>
                        <option value="25">MS</option>
                        <option value="26">MO</option>
                        <option value="27">MT</option>
                        <option value="28">NE</option>
                        <option value="29">NV</option>
                        <option value="30">NH</option>
                        <option value="31">NJ</option>
                        <option value="32">NM</option>
                        <option value="33">NY</option>
                        <option value="34">NC</option>
                        <option value="35">ND</option>
                        <option value="36">OH</option>
                        <option value="37">OK</option>
                        <option value="38">OR</option>
                        <option value="39">PA</option>
                        <option value="40">RI</option>
                        <option value="41">SC</option>
                        <option value="42">SD</option>
                        <option value="43">TN</option>
                        <option value="44">TX</option>
                        <option value="45">UT</option>
                        <option value="46">VT</option>
                        <option value="47">VA</option>
                        <option value="48">WA</option>
                        <option value="49">WV</option>
                        <option value="50">WI</option>
                        <option value="51">WY</option>
                        <option value="52">AS</option>
                        <option value="53">PR</option>
                        <option value="54">VI</option>
                        <option value="55">GU</option>
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

            <div class="row">
                <div class="col-6">
                    <div class="form-row">
                        <div class="form-group">
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
                        <div class="form-group">
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
                </div>
                <div class="col-6">
                    <div class="form-row">
                        <div class="col-6 form-group">
                            <label for="planType">Plan Type</label>
                            <select name="planType" class="custom-select">
                                <option value="0" default>Medicare Advantage</option>
                                <option value="1">Medicaid</option>
                                <option value="2">Commercial</option>
                                <option value="3">Medicare FFS</option>
                                <option value="4">Aging-In</option>
                            </select>
                        </div>
                        <div class="col-6 form-group">
                            <label for="planTypeDetail">Detail</label>
                            <input type="text" name="planTypeDetail" class="form-control" id="planTypeDetail">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="pcpName">PCP Name</label>
                            <select name="pcpName" id="pcpName" class="form-control">
                                <option value="">Choose...</option>
                                @foreach($doctors as $doc)
                                <option value="{{$doc->id}}">{{$doc->first_name." ".$doc->last_name}}, {{$doc->type}}</option>
                                @endforeach
                                <option value="0">Other..See Notes...</option>
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
                <textarea name="notes" class="form-control" id="notes" rows="3"></textarea>
            </div>
            <hr>
            <div class="btn-group d-flex" role="group">
                <button type="reset" class="btn btn-lg btn-danger m-1">Dismiss</button> <!-- must validate "Are you sure this patient has declined / must correspond with correct selection" -->
                <button type="submit" class="btn btn-lg btn-success m-1">Add</button> <!-- must correspond with corrent selection above -->
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
