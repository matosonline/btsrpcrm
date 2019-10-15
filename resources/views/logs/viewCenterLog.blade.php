@extends('layout.mainlayout')

@section('content')
<div class="table-responsive view_centerLog_wrap">
        <table class="table table-striped view_centerLog_table" id="view_centerLog_table">
            <thead>
                <tr>
                    <th>No.</th>
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
<link rel="stylesheet" type="text/css"
    href="{{url('/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{url('/assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
@endsection
@section('pagescript')
<script>
    $('#main_header').html("View Center Log");
</script>
<script type="text/javascript">
$(function () {
    $('.view_centerLog_table').DataTable({searching: false, paging: true, info: false, lengthChange: false, pageLength: 5, order: false});
});
</script>
<script src="{{url('/js/jquery_validation/jquery.validate.js')}}"></script>
<script src="{{url('/js/jquery_validation/additional-methods.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
@endsection