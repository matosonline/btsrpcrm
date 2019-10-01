@extends('layout.mainlayout')

@section('content')

   <!-- JS Chart -->
            {{-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> --}}

            <!-- Leaderboard -->
            <div class="row mb-5">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3 mb-sm-3 mb-lg-0 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            Total Leads
                        </div>
                        <div class="card-body">
                            <h1 class="card-title text-center">{{count($totalLeads)}}</h1>
                            <p class="card-text text-muted">Last Updated - mmddyyy/p>
                            {{-- <a href="#" class="btn btn-sm btn-primary">Go somewhere</a> --}}
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3 mb-sm-3 mb-lg-0 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            Closed Leads
                        </div>
                        <div class="card-body">
                            <h1 class="card-title text-center">{{count($closeLeads)}}</h1>
                            <p class="card-text text-muted">Last Updated - mmddyyy</p>
                            {{-- <a href="#" class="btn btn-sm btn-primary">Go somewhere</a> --}}
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3 mb-sm-0 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            New Leads
                        </div>
                        <div class="card-body">
                            <h1 class="card-title text-center">{{count($newLeads)}}</h1>
                            <p class="card-text text-muted">Last Updated - mmddyyy</p>
                            {{-- <a href="#" class="btn btn-sm btn-primary">Go somewhere</a> --}}
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            Total Opted Out
                        </div>
                        <div class="card-body">
                            <h1 class="card-title text-center">{{count($totalOptedOut)}}</h1>
                            <p class="card-text text-muted">Last Updated - mmddyyy</p>
                            {{-- <a href="#" class="btn btn-sm btn-primary">Go somewhere</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Leaderboard -->
            <hr>

            <!-- Table(s) -->
			<div class="row mt-3 mb-5">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
                                <h5>All</h5>
                                <div class="btn-toolbar mb-2 mb-md-0"> <!-- PAGINATION -->
                                    <div class="btn-group mr-2" role="group">
                                        <button type="button" class="btn btn-outline-primary">1</button>
                                        <button type="button" class="btn btn-outline-primary">2</button>
                                        <button type="button" class="btn btn-outline-primary">3</button>
                                        <button type="button" class="btn btn-outline-primary">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Lead</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>DOB</th>
                                        <th>Lead Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($leads as $row)
                                        <tr>
                                            <td><a href="{{url('/editLead/'.$row['id'])}}" name="edit" aria-label="Edit" title="Edit">{{ $row['id'] }}</a></td>
                                            <td>{{ $row['fName'] . ' ' . $row['lName']}}</td>
                                            <td><span class="bfh-phone" data-format="(ddd) ddd-dddd" data-number="{{ $row['phone1'] }}"></span></td>
                                            <td>{{ $row['dob'] }}</td>
                                            @if($row['lStatus'] == 1 )
                                                <td>New</td>
                                            @elseif($row['lStatus'] == 2)
                                                <td>Pending</td>
                                            @elseif($row['lStatus'] == 3)
                                                <td>Closed Success</td>
                                            @elseif($row['lStatus'] == 4)
                                                <td>Lost Failure</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a class="nav-link {{Request::is('leads') || Request::is('newLead') || Request::is('editLead/*')?"active":''}}" href="{{ route('leads.index') }}">
                                <button type="button" class="btn btn-outline-primary btn-block">View All</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Table(s) -->
            </div>
          </main>
        </div>
      </div>
<!--              -->
<!-- END CONTENT  -->
<!--              -->

@endsection

<b></b>
