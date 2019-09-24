@extends('layout.mainlayout')

@section('content')

{{-- insert alert messgs here --}}

    <div class="card col-8 mx-auto p-3">

        <form action="#" method="POST">
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
                    <input class="form-control" type="date" name="dob" id="dob">
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
                        <option value="null">SELECT...</option>
                        <option value="1">M.D.</option>
                        <option value="2">D.O.</option>
                        <option value="3">M.B.B.S.</option>
                        <option value="4">R.N.</option>
                        <option value="5">N.P.</option>
                        <option value="6">A.R.N.P.</option>
                        <option value="7">A.P.R.N.</option>
                        <option value="8">C.N.M.</option>
                        <option value="9">C.N.P.</option>
                        <option value="10">C.R.N.A.</option>
                        <option value="11">D.N.P.</option>
                        <option value="12">L.P.N.</option>
                        <option value="13">P.A.</option>
                        <option value="14">P.A.-C.</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="spec">Primary Specialty</label>
                    <input class="form-control" type="text" name="spec" id="spec">
                </div>
                <div class="form-group col-md-6">
                    <label for="lang">Spoken Languages <span class="text-nuted text-italic">(ctl+click Select Multiple)</span> </label>
                    <select multiple name="lang" id="lang" class="form-control">
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
            <div class="row mb-4">
                <div class="col-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="phpCheck" id="phpCheck" value="1">
                        <label class="form-check-label" for="phpCheck">
                            Preferred Care Partners (PCP)/UHC
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <label for="pcpStartDate" class="form-label">Start Date</label>
                    <input class="form-control" type="date" id="pcpStartDate">
                </div>
                <div class="col-4">
                    <label for="pcpTermDate" class="form-label">Term Date</label>
                    <input class="form-control" type="date" id="pcpTermDate">
                </div>
            </div>
        <hr>
            <div class="row mb-4">
                <div class="col-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="medicaCheck" id="medicaCheck" value="2">
                        <label class="form-check-label" for="medicaCheck">
                            Medica/UHC
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <label for="medicaStartDate" class="form-label">Start Date</label>
                    <input class="form-control" type="date" id="medicaStartDate">
                </div>
                <div class="col-4">
                    <label for="medicaTermDate" class="form-label">Term Date</label>
                    <input class="form-control" type="date" id="medicaTermDate">
                </div>
            </div>
        <hr>
            <div class="row mb-4">
                <div class="col-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="cpCheck" id="cpCheck" value="3">
                        <label class="form-check-label" for="cpCheck">
                            Care-Plus
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <label for="cpStartDate" class="form-label">Start Date</label>
                    <input class="form-control" type="date" id="cpStartDate">
                </div>
                <div class="col-4">
                    <label for="cpTermDate" class="form-label">Term Date</label>
                    <input class="form-control" type="date" id="cpTermDate">
                </div>
            </div>
        <hr>
            <div class="row mb-4">
                <div class="col-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="simplyCheck" id="simplyCheck" value="4">
                        <label class="form-check-label" for="simplyCheck">
                            Simply
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <label for="simplyStartDate" class="form-label">Start Date</label>
                    <input class="form-control" type="date" id="simplyStartDate">
                </div>
                <div class="col-4">
                    <label for="simplyTermDate" class="form-label">Term Date</label>
                    <input class="form-control" type="date" id="simplyTermDate">
                </div>
            </div>
        <hr>
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

<b></b>
