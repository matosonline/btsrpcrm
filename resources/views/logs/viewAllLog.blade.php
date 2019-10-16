@extends('layout.mainlayout')

@section('content')
<div class="view_userLog_wrap mb-4">
        <table class="table table-striped view_userLog_table" id="view_userLog_table" width="100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Activity Name</th>
                    <th>UserName</th>
                    <th>Log Date</th>
                    <th>Old Data</th>
                    <th>New Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logArray as $key => $row)
               
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$logArray[$key]['activity_name']}}</td>
                    <td>{{$logArray[$key]['username']}}</td>
                    <td>{{$logArray[$key]['created_at']}}</td>
                    <td style="width:50%">{{($logArray[$key]['old_data'])}}</td>
                    <td style="width:50%">{{$logArray[$key]['new_data']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('pagecss')
<link rel="stylesheet" type="text/css" href="{{url('/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('pagescript')
<script>
    $('#main_header').html("View Logs");
</script>
<script type="text/javascript">
$(function () {
    $('.view_userLog_table').DataTable({
        order: [0,'desc'],
        dom:"<'row'<'col-12 col-sm-6'l><'col-12 col-sm-6'f>>" +
            "<'row'<'col-sm-12'<'table-responsive'tr>>>" +
            "<'row'<'col-12 col-sm-6'i><'col-12 col-sm-6'p>>",
        drawCallback: function () {
            $('.dataTables_paginate > .pagination').addClass('justify-content-center justify-content-md-end');
            $('.dataTables_wrapper').removeClass('container-fluid');
            $('.dataTables_length').addClass('text-left');
            $('.dataTables_filter').addClass('text-left text-md-right');
        }
    });
});
</script>
<script src="{{url('/js/jquery_validation/jquery.validate.js')}}"></script>
<script src="{{url('/js/jquery_validation/additional-methods.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
@endsection