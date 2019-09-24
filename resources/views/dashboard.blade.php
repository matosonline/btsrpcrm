@extends('layout.mainlayout')

@section('content')

            <!-- JS Chart -->
            {{-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> --}}

            <!-- Leaderboard -->
            <div class="row mb-5">
                <div class="col-sm-3 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            header
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">title</h5>
                            <p class="card-text text-muted">subtext.</p>
                            {{-- <a href="#" class="btn btn-sm btn-primary">Go somewhere</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            header
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">title</h5>
                            <p class="card-text text-muted">subtext.</p>
                            {{-- <a href="#" class="btn btn-sm btn-primary">Go somewhere</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            header
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">title</h5>
                            <p class="card-text text-muted">subtext.</p>
                            {{-- <a href="#" class="btn btn-sm btn-primary">Go somewhere</a> --}}
                        </div>
                    </div>
                </div>
            </div>

            <hr>

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
                        {{-- {{-- @foreach($leads as $row) --}}
                        <tr>
                            <td><a href="{{ route('agentLead') }}">id</a></td>
                            <td>'fName'</td>
                            <td>'lName'</td>
                            <td>'phone1'</td>
                            <td>'dob'</td>
                        </tr>
                        {{-- @endforeach --}}
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
