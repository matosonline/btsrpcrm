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

        <form action="{{ route('lead.store') }}" method="POST">
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
                <div class="form-group col-sm-4 mx-auto">
                    <label for="dob">Date of Birth</label>
                    <input class="form-control" type="date" name="dob" id="dob">
                </div>
                <div class="form-group col-sm-4 mx-auto">
                    <label for="lang">Preferred Language</label>
                    <select name="lang" id="lang" class="form-control">
                        <option value="1">English</option>
                        <option value="2">Spanish</option>
                        <option value="3">Creole</option>
                        <option value="4">Portuguese</option>
                    </select>
                </div>
                <div class="form-group col-sm-4 mx-auto">
                    <label for="careID">Medicare ID#</label>
                    <input class="form-control" type="text" name="careID" id="careID">
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
                        <option selected>Choose...</option>
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
                    <div class="for-row">
                        <div class="form-group">
                            <label for="healthPlan">Health Plan</label>
                            <select name="healthPlan" id="healthPlan" class="form-control">
                                <option value="0">Choose...</option>
                                <option value="1">Simply</option>
                                <option value="2">CarePlus</option>
                                <option value="3">Medica</option>
                                <option value="4">PCP</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group mx-auto">
                        <label for="startDate">Start Date</label>
                        <input class="form-control" type="date" name="startDate" id="startDate">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="pcp">Primary Care Provider</label>
                    <select name="pcp" id="pcp" class="form-control">
                        <option selected>Choose...</option>
                        <option value="1">ANNA MARIA ASUNCION, MD</option>
                        <option value="2">VIVIAN BIRNBAUM, MD</option>
                        <option value="3">SABRINA CURRY , ARNP</option>
                        <option value="4">DORIS DANKO, MD</option>
                        <option value="5">NATASSJA GANGERI, DO</option>
                        <option value="6">ELISA GEORGE, MD</option>
                        <option value="7">ROBERT GOLDSZER, MD</option>
                        <option value="8">ANDREW HARRIS, DO</option>
                        <option value="9">LARISSA HERNANDEZ, MD</option>
                        <option value="10">GRACE IMSON, MD</option>
                        <option value="11">ELIZABETH KURY-PEREZ, MD</option>
                        <option value="12">JOSE LAMPREABE, MD</option>
                        <option value="13">JANELLA LEON, DO</option>
                        <option value="14">CORNEL LUPU, MD</option>
                        <option value="15">CLIFFORD MEDINA, MD</option>
                        <option value="16">GEORGI MILLER, MD</option>
                        <option value="17">CRYSTAL REGO, DO</option>
                        <option value="18">JAY REINBERG, MD</option>
                        <option value="19">SYLVANA SAINTICHE, ARNP</option>
                        <option value="20">CRAIG SILVER, MD</option>
                        <option value="21">ANDRE TAMAYO-CHELALA, DO</option>
                    </select>
                </div>
            </div>
            <div class="form-group mt-4">
                <label for="notes">Notes</label>
                <textarea name="notes" class="form-control" id="notes" rows="3"></textarea>
            </div>
        <hr>
            <div class="row">
                <div class="col-6">
                    <label for="lStatus">Lead Status</label>
                    <select name="lStatus" id="lStatus" class="form-control">
                        <option value="0">New</option>
                        <option value="1">Pending</option>
                        <option value="2">Closed <span class="test-success text-italic">Success</span></option>
                        <option value="3">Lost <span class="test-danger text-italic">Failure</span></option>
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
                <button type="submit" class="btn btn-lg btn-success m-1">Add</button> <!-- must correspond with corrent selection above -->
            </div>

        </form>
    </div>

@endsection

<b></b>
