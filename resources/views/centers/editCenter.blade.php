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
         <form action="{{ route('center.store') }}" method="POST" id="center_form" name="center_form">
            @csrf
             <input type="hidden" name="id" id="id" value="{{$center_details->id}}">
            <div class="form-row">
                <div class="form-group col">
                    <label for="centerName">Center Name</label>
                    <input type="text" class="form-control" id="centerName" placeholder="Center Name" name="centerName"
                           value="{{$center_details->centerName}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="inputAddress"
                       value="{{$center_details->inputAddress}}">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address 2</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" name="inputAddress2"
                       value="{{$center_details->inputAddress2}}">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity" name="inputCity" value="{{$center_details->inputCity}}"> 
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select name="inputState" id="inputState" class="form-control">
                        <option selected value="">Choose...</option>
                        @foreach($state as $val)
                            <option value="{{$val->id}}" {{$val->id == $center_details->inputState ?'selected':''}}>{{$val->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" class="form-control" id="inputZip" name="inputZip" value="{{$center_details->inputZip}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phone1">Phone Number</label>
                    <input type="text" class="form-control" id="phone1" placeholder="Phone Number" name="phone1" value="{{$center_details->phone1}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="fax1">Fax Number</label>
                    <input type="fax1" class="form-control" id="fax1" placeholder="Fax Number" name="fax1" value="{{$center_details->fax1}}">
                </div>

            </div>

            <!-- Table -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
                <h5>Center Providers</h5>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                    <a href="{{ route('newProvider') }}"><button type="button" class="btn btn-sm btn-outline-success">Add Provider</button></a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">NPI</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">##########</th>
                            <td>Mark</td>
                            <td>Otto</td>
                        </tr>
                        <tr>
                            <th scope="row">##########</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                        </tr>
                        <tr>
                            <th scope="row">##########</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr>
            <button type="reset" class="btn btn-secondary float-right m-1">Discard</button>
            <button type="submit" class="btn btn-success float-right m-1">Add</button>
        </form>
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
