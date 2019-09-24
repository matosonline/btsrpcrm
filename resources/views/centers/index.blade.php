@extends('layout.mainlayout')

@section('content')

    <!-- Table -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
                <h5>Centers</h5>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                    <a href="{{ route('newCenter') }}"><button type="button" class="btn btn-sm btn-outline-success">Add Center</button></a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Center ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($leads as $row) --}}
                        <tr>
                            <td>'id'</td>
                            <td>'cName'</td>
                            <td>'address1'.'address2'.'city'.'state'.'zip'</td>
                            <td>'phone1'</td>
                        </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>

@endsection
