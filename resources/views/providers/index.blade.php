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
                    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('msmc-manager'))
                        <th>View Logs</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            @if(!empty($doctors))
                @foreach($doctors as $row)
                <tr>
                    <td><a href="{{url('/editProvider/'.$row['id'])}}">{{$row['npi']}}</a></td>
                    <td>{{$row['first_name'].' '.$row['last_name']}}</td>
                    <td>{{$row['primary_speciality']}}</td>
                    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('msmc-manager'))
                        <td><a href="{{url('/viewProviderLog/'.$row['id'])}}"><span data-feather='eye'></span></a></td>
                    @endif
                </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

@endsection
