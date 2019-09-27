@extends('layout.mainlayout')

@section('content')

    <!-- Table -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
                <h5>Centers</h5>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                    <a href="{{ url('/newCenter') }}"><button type="button" class="btn btn-sm btn-outline-success">Add Center</button></a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                @if(count($center)>0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Center ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $stateArray = array('AL','AK','AZ','AR','CA','CO','CT','DE','DC','FL','GA','HI','ID','IL','IN','IA','KS','KY','LA','ME','MD','MA','MI','MN','MS','MO','MT','NE','NV','NH','NJ','NM','NY','NC','ND','OH','OK','OR','PA','RI','SC','SD','TN','TX','UT','VT','VA','WA','WV','WI','WY','AS','PR','VI','GU');@endphp
                            @foreach($center as $row)
                            <tr>
                                <td>{{$row['id']}}</td>
                                <td>{{$row['centerName']}}</td>
                                <td>{{$row['inputAddress'].' '.$row['inputAddress2'].' '.$row['inputCity'].' '.$stateArray[$row['inputState']-1].' '.$row['inputZip']}}</td>
                                <td>{{$row['phone1']}}</td>
                                <td><a class="btn" href="{{url('/editCenter/'.$row['id'])}}" type="button" name="edit" aria-label="Edit"
                                        title="Edit"><i class="fa fas fa-edit"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

@endsection
