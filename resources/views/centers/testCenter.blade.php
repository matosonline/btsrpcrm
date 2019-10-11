@extends('layout.mainlayout')

@section('content')
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <form action="#" method="POST" id="center_form" name="center_form">
                    @csrf
                    <input type="hidden" name="id" id="id" value="#">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="centerName">Center Name</label>
                            <input type="text" class="form-control" id="centerName" placeholder="Center Name" name="centerName" value="#">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="npi">NPI <span class="font-italic">type 2</span></label>
                            <input type="text" class="form-control" id="npi" placeholder="NPI" name="npi" value="#">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ccn">CCN</label>
                            <input type="text" class="form-control" id="ccn" placeholder="CCN" name="ccn" value="#">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="inputAddress"
                            value="#">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Address 2</label>
                        <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" name="inputAddress2"
                            value="#">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" id="inputCity" name="inputCity" value="#"> 
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState">State</label>
                            <select name="inputState" id="inputState" class="form-control">
                                <option selected value="">Choose...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">Zip</label>
                            <input type="text" class="form-control" id="inputZip" name="inputZip" value="#">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phone1">Phone Number</label>
                            <input type="text" class="form-control" id="phone1" placeholder="Phone Number" name="phone1" value="#">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fax1">Fax Number</label>
                            <input type="fax1" class="form-control" id="fax1" placeholder="Fax Number" name="fax1" value="#">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="transportation" class="col-sm-2 col-form-label">Transportation</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="transportation">
                        </div>
                    </div>
                </form>
            </div>
                        <div class="card-footer"></div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="accordion" id="editCenterAccordion">
            
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Staff/Providers</h5>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#editCenterAccordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped">
                                    <thead>
                                        <tr>
                                            <th>NPI</th>
                                            <th>Provider Name</th>
                                            <th>Specialty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="#">0123456789</a></td> <!-- link to Provider record -->
                                            <td>Dr. So N. So</td>
                                            <td>*ology</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-success btn-sm float-right mb-3 mr-3">Add Payor</button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="False" aria-controls="collapseTwo">Hours of Operation</h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#editCenterAccordion">
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="timeFrom-To" class="col-sm-3 col-form-label"><span class="font-weight-bold">Sunday</span></label>
                                <div class="col-sm-4 mx-auto">
                                    <input type="time" class="form-control" id="timeFrom">
                                </div>
                                to
                                <div class="col-sm-4 mx-auto">
                                    <input type="time" class="form-control" id="timeTo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="timeFrom-To" class="col-sm-3 col-form-label"><span class="font-weight-bold">Monday</span></label>
                                <div class="col-sm-4 mx-auto">
                                    <input type="time" class="form-control" id="timeFrom">
                                </div>
                                to
                                <div class="col-sm-4 mx-auto">
                                    <input type="time" class="form-control" id="timeTo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="timeFrom-To" class="col-sm-3 col-form-label"><span class="font-weight-bold">Tuesday</span></label>
                                <div class="col-sm-4 mx-auto">
                                    <input type="time" class="form-control" id="timeFrom">
                                </div>
                                to
                                <div class="col-sm-4 mx-auto">
                                    <input type="time" class="form-control" id="timeTo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="timeFrom-To" class="col-sm-3 col-form-label"><span class="font-weight-bold">Wednesday</span></label>
                                <div class="col-sm-4 mx-auto">
                                    <input type="time" class="form-control" id="timeFrom">
                                </div>
                                to
                                <div class="col-sm-4 mx-auto">
                                    <input type="time" class="form-control" id="timeTo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="timeFrom-To" class="col-sm-3 col-form-label"><span class="font-weight-bold">Thursday</span></label>
                                <div class="col-sm-4 mx-auto">
                                    <input type="time" class="form-control" id="timeFrom">
                                </div>
                                to
                                <div class="col-sm-4 mx-auto">
                                    <input type="time" class="form-control" id="timeTo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="timeFrom-To" class="col-sm-3 col-form-label"><span class="font-weight-bold">Friday</span></label>
                                <div class="col-sm-4 mx-auto">
                                    <input type="time" class="form-control" id="timeFrom">
                                </div>
                                to
                                <div class="col-sm-4 mx-auto">
                                    <input type="time" class="form-control" id="timeTo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="timeFrom-To" class="col-sm-3 col-form-label"><span class="font-weight-bold">Saturday</span></label>
                                <div class="col-sm-4 mx-auto">
                                    <input type="time" class="form-control" id="timeFrom">
                                </div>
                                to
                                <div class="col-sm-4 mx-auto">
                                    <input type="time" class="form-control" id="timeTo">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title" data-toggle="collapse" data-target="#collapseThree" aria-expanded="False" aria-controls="collapseThree">Services/Procedures</h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#editCenterAccordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul>
                                    <li>list item one</li>
                                    <li>list item two</li>
                                    <li>list item three</li>
                                    <li>list item four</li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul>
                                    <li>list item five</li>
                                    <li>list item six</li>
                                    <li>list item seven</li>
                                    <li>list item eight</li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <form action="#" method="post">
                                    <div class="form-group row">
                                        <label for="addService" class="col-sm-4 col-form-label"><span class="font-weight-bold">Add Serivice/Procedure</span></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="addService">
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Notes</h5>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#editCenterAccordion">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <div class="mb-2">
                                    <span class="small text-muted">yyyy/mm/dd - userName: </span> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tincidunt ut nunc eu eleifend. Curabitur sit amet lectus mi. Aenean viverra neque sit amet augue pulvinar rhoncus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris id ex aliquam, molestie libero vitae, tempor sapien.
                                </div>
                                <div>
                                    <span class="small text-muted">yyyy/mm/dd - userName: </span> Mauris ornare sagittis eros id suscipit. Nulla cursus tempor massa vel feugiat. Ut eu ante ut lacus egestas euismod ac quis augue. Nulla nec elit sollicitudin, molestie dui cursus, blandit mi. In at porta nisl. Phasellus a nulla ante. Pellentesque imperdiet dui in elit imperdiet, id vulputate tortor facilisis.
                                </div>
                            </div>
                        </div>
                    <hr>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="newNote">NewNote</label>
                                <textarea class="form-control" id="newNote" rows="3"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-outline-success float-right mb-3">Add</button>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">Attachments</h5>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#editCenterAccordion">
                    <div class="card-body">
                        <form action="#" method="post">
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-6">
                                    <label for="uploadDocs">Upload Files</label>
                                    <input type="file" name="uploadDocs[]" class="form-control-file" id="uploadDocs" multiple>
                                </div>
                            </div>
                            <div class="form-row mt-2">
                                {{-- @if(!$getAttachment->isempty()) --}}
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>FileName</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                {{-- @foreach($getAttachment as $val) --}}
                                            <tr class="attach_row" id="attach_{{-- $val->id}} --}}">
                                                <td><span data-feather="file"></span> {{-- substr($val->filename, strpos($val->filename, "]") + 1)}} --}}</td>
                                                <td><span data-feather="trash-2" class="danger_color attach_delete" data-attach="{{-- $val->id}} --}}"></span></td>
                                            </tr>
                                                {{-- @endforeach --}}
                                        </tbody>
                                    </table>
                                </div>
                                {{-- @endif --}}
                            </div>
                        </form>
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



@endsection
@section('pagecss')
<link rel="stylesheet" href="{{url('/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
@endsection
@section('pagescript')
<script>
    $('#main_header').html('Edit Center');
</script>

<script src="{{url('/js/jquery_validation/jquery.validate.js')}}"></script>
<script src="{{url('/js/jquery_validation/additional-methods.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('/js/center.js')}}"></script>
@endsection
<b></b>
