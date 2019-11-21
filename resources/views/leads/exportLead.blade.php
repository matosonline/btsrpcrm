                <div class="card-body">
                        <div class="table-responsive">
                            <table id="holiday_listing" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Date of Birth</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Attestation</th>
                                        <th>Assigned Agent</th>
                                        <th>Status</th>       
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($query)>0)  

                                    @foreach($query as $dataVal)
                                    @php
                                        $changePhone = 0 ;
                                        $phone = ($dataVal->phone1 != '(')?((strpos($dataVal->phone1, '(') !== false && strpos($dataVal->phone1, ')') !== false)?$dataVal->phone1:$changePhone = $dataVal->phone1):'';
                                        if($changePhone != 0){
                                            $phone  = '('.substr($changePhone,0,3).') '.substr($changePhone,3,3)."-".substr($changePhone,6,4);
                                        }
                                        
                                        $attestation = ($dataVal->agreeOrDisagree != '')?($dataVal->agreeOrDisagree == 1?'Agree':'Disagree'):'';
                                        $status = '';
                                        if($dataVal->lStatus != '' && $dataVal->lStatus == 1){
                                            $status = 'New';
                                        }elseif($dataVal->lStatus != '' && $dataVal->lStatus == 2){
                                            $status = 'Pending';
                                        }elseif($dataVal->lStatus != '' && $dataVal->lStatus == 3){
                                            $status = 'Closed | Success';
                                        }elseif($dataVal->lStatus != '' && $dataVal->lStatus == 4){
                                            $status = 'LOST | Failure';
                                        }elseif($dataVal->lStatus != '' && $dataVal->lStatus == 5){
                                            $status = 'Pending | Appointment Scheduled';
                                        }else{
                                             $status = 'Pending - No Answer';
                                        }
                                    @endphp 
                                    <tr>
                                        <td>{{$dataVal->leadId}}</td>
                                        <td>{{$dataVal->Name}}</td>
                                        <td>{{$dataVal->dob}}</td>
                                        <td>{{$phone}}</td>
                                        <td>{{$dataVal->email}}</td>
                                        <td>{{$attestation}}</td>
                                        <td>{{$dataVal->agentName}}</td>
                                        <td>{{$status}}</td>
                                        <td>{{$dataVal->created_at}}</td>
                                    </tr>
                                    @endforeach 
                                    @else
                                    <tr>
                                        <td colspan='10'>No Record Found.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
    
                    </div>

   