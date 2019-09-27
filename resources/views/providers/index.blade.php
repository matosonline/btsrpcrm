@extends('layout.mainlayout')

@section('content')

    <!-- Table -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
        <h5>Providers</h5>
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
                    <th>NPI</th>
                    <th>Name</th>
                    <th>Specialty</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach($leads as $row) --}}
                <tr>
                    <td><a href="#">'npi'</a></td>
                    <td>'fName' . 'lName'</td>
                    <td>'specialty'</td>
                </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>

@endsection
