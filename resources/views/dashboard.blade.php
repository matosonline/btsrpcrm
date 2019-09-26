@extends('layout.mainlayout')

@section('content')

            <!-- JS Chart -->
            {{-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> --}}

            <!-- Leaderboard -->
            <div class="row mb-5">
                <div class="col-sm-2 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            Total Leads
                        </div>
                        <div class="card-body">
                            <h1 class="card-title text-center">##</h1>
                            <p class="card-text text-muted">Last Updated - mmddyyy</p>
                            {{-- <a href="#" class="btn btn-sm btn-primary">Go somewhere</a> --}}
                        </div>
                    </div>
                </div>

                <div class="col-sm-2 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            New Leads
                        </div>
                        <div class="card-body">
                            <h1 class="card-title text-center">##</h1>
                            <p class="card-text text-muted">Last Updated - mmddyyy</p>
                            {{-- <a href="#" class="btn btn-sm btn-primary">Go somewhere</a> --}}
                        </div>
                    </div>
                </div>

                <div class="col-sm-2 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            Total Opted Out
                        </div>
                        <div class="card-body">
                            <h1 class="card-title text-center">##</h1>
                            <p class="card-text text-muted">Last Updated - mmddyyy</p>
                            {{-- <a href="#" class="btn btn-sm btn-primary">Go somewhere</a> --}}
                        </div>
                    </div>
                </div>

            </div>

            <hr>

            <!-- Table -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
                <h5>My Leads</h5>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                    <a href="{{ url('/newLead') }}"><button type="button" class="btn btn-sm btn-outline-success">New Lead</button></a>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leads as $row)
                            
                            <tr>
                                    <td>{{ $row['id'] }}</td>
                                    <td>{{ $row['fName'] }}</td>
                                    <td>{{ $row['lName'] }}</td>
                                    <td>{{ $row['phone1'] }}</td>
                                    <td>{{ $row['dob'] }}</td>
                                    <td><a class="btn" href="{{url('/editLead/'.$row['id'])}}" type="button" name="edit" aria-label="Edit"
                                        title="Edit"><i class="fa fas fa-edit"></i></a></td>
                            </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
          </main>
        </div>
      </div>
<!--              -->
<!-- END CONTENT  -->
<!--              -->

@endsection

<b></b>
