@extends('layout.mainlayout')

@section('content')

    <!-- Table -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
                <h5>Leads</h5>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                    <a href="{{ route('lead.view') }}"><button type="button" class="btn btn-sm btn-outline-success">New Lead</button></a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Lead</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th>DOB</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leads as $row)
                        <tr>
                            <td>{{ $row['id'] }}</td>
                            <td>{{ $row['fName'] }}</td>
                            <td>{{ $row['fName'] }}</td>
                            <td>{{ $row['phone1'] }}</td>
                            <td>{{ $row['dob'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

@endsection
