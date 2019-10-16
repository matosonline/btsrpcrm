@extends('layout.mainlayout')

@section('content')

   <!-- JS Chart -->
            {{-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> --}}

            <!-- Leaderboard -->
            <div class="row mb-5">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3 mb-sm-3 mb-lg-0 mx-auto">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div><a href="{{ route('leads.index') }}">Total Leads</a></div>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title text-center">{{count($totalLeads)}}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3 mb-sm-0 mx-auto">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div><a href="{{ url('/leads?status='.encrypt('unassigned')) }}">Unassigned</a></div>
                            <div><a href="{{ url('/leads?status='.encrypt('1')) }}">New Leads</a></div>
                        </div>
                        
                        <div class="card-body">
                            <h1 class="card-title text-center">{{count($totalUassigned)}}/{{count($newLeads) }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3 mb-sm-3 mb-lg-0 mx-auto">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div><a href="{{ url('/leads?status='.encrypt('4')) }}">Lost Leads</a></div>
                            <div><a href="{{ url('/leads?status='.encrypt('optedOut')) }}">Opted Out</a></div>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title text-center">{{count($lostLeads)}}/{{count($totalOptedOut) }}</h1>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3 mb-sm-3 mb-lg-0 mx-auto">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div><a href="{{ url('/leads?status='.encrypt('3')) }}">Closed Leads</a></div>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title text-center">{{count($closeLeads)}}</h1>
                        </div>
                    </div>
                </div>

            </div>
            <!-- END Leaderboard -->
            <hr>

            <!-- Table(s) -->
			<div class="row mt-3 mb-5">
                <div class="col custom_footable">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
                                <h5>All</h5>
                                <div class="table_pagination_daashboard"></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped dashboard_leade_table">
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
                                            @elseif($row['lStatus'] == 5)
                                                <td>Appointment scheduled</td>
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
@section('pagecss')
<link rel="stylesheet" type="text/css"
    href="{{url('/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('pagescript')
<script src="{{url('/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript">
$(function () {
    $('.dashboard_leade_table').DataTable({
        dom:"<'row'<'col-12 col-sm-6'l><'col-12 col-sm-6'f>>" +
            "<'row'<'col-sm-12'<'table-responsive'tr>>>" +
            "<'row'<'col-12 col-sm-6'i><'col-12 col-sm-6'p>>",
        order:[0,'desc'],
        initComplete: (settings, json)=>{
            $('.dataTables_paginate').appendTo('.table_pagination_daashboard');
        },searching: true, paging: true, info: false, lengthChange: false, pageLength: 10, orderable: true,
    });
});
</script>
@endsection
