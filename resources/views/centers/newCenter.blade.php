@extends('layout.mainlayout')

@section('content')

    <div class="card col-8 mx-auto p-3">
        <form>
            <div class="form-row">
                <div class="form-group col">
                    <label for="centerName">Center Name</label>
                    <input type="text" class="form-control" id="centerName" placeholder="Center Name">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address 2</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select id="inputState" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phone1">Phone Number</label>
                    <input type="text" class="form-control" id="phone1" placeholder="Phone Number">
                </div>
                <div class="form-group col-md-6">
                    <label for="fax1">Fax Number</label>
                    <input type="fax1" class="form-control" id="fax1" placeholder="Fax Number">
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

            <button type="submit" class="btn btn-secondary float-right m-1">Discard</button>
            <button type="submit" class="btn btn-success float-right m-1">Add</button>
        </form>
    </div>

@endsection

<b></b>
