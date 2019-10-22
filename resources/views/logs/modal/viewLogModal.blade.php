<div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header card-header bg-dark"style="color: #fff;">
                <h4 class="modal-title">Log Details</h4>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 1;">&times;</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="log_detail_listing" class="table table-striped table-bordered">
                        @if(!$logData->isEmpty())
                        <thead>
                            <tr>
                                <th>Field Name</th>
                                <th>Old Data</th>
                                <th>New Data</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $lang = array(1 => 'English',2=>'Spanish',3=>'Creole',4=>'Portuguese');
                        @endphp
                        @if($log_view_type == 'lead')
                            @php 
                                $pcpArray = array(); 
                                $agreeStatus = array(1 => 'Agree',2=>'Disagree');
                                $planType = array(0 => 'Medicare Advantage',1 =>'Medicaid',2=>'Commercial',3=>'Medicare FFS',4=>'Aging-In',5=>'Humana');
                                $inquireType = array(1 => 'Stay with current PCP',2=>'New MSMC PCP');
                                $leadStatus = array(1 => 'New',2=>'Pending',3=>'Close',4=>'Lost',5=>'Pending Appointment Scheduled');
                            @endphp
                            @foreach($doctors as $doc)
                                @php
                                    $pcpArray[$doc->id] = $doc->first_name." ".$doc->last_name;
                                    $keyArray[] = $doc->id;
                                @endphp
                            @endforeach
                                @foreach($logData as $val)
                                @php 
                                    $oldData = json_decode($val->old_data,true);
                                    $newData = json_decode($val->new_data,true);
                                    $createBy = ($oldData['created_by'] != '')?(new \App\Helpers\CommonHelper)->getNameById($oldData['created_by']):'';
                                    $updateBy = ($oldData['updated_by'] != '')?(new \App\Helpers\CommonHelper)->getNameById($newData['updated_by']):'';
                                @endphp
                                <tr>
                                    <td>Name</td>
                                    <td>{{$oldData['fName'].' '.$oldData['lName']}}</td>
                                    <td>{{$newData['fName'].' '.$newData['lName']}}</td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>{{$oldData['phone1'].' '.$oldData['phone1']}}</td>
                                    <td>{{$newData['phone1'].' '.$newData['phone1']}}</td>
                                </tr>
                                <tr>
                                    <td>Language</td>
                                    <td>{{($oldData['lang'] != '')?$lang[$oldData['lang']]:''}}</td>
                                    <td>{{($newData['lang'] != '')?$lang[$newData['lang']]:''}}</td>
                                </tr>
                                <tr>
                                    <td>Agree/Disagree</td>
                                    <td>{{($oldData['agreeOrDisagree'] != '')?$agreeStatus[$oldData['agreeOrDisagree']]:''}}</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Play Type</td>
                                    <td>{{$planType[$oldData['planType']]}}</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Inquire Type</td>
                                    <td>{{($oldData['inquire_type'] != '')?$inquireType[$oldData['inquire_type']]:''}}</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>PCP Name</td>
                                    <td>{{(in_array($oldData['pcpName'], $keyArray) ?$pcpArray[$oldData['pcpName']]:$oldData['pcpName'])}}</td>
                                    <td>{{(in_array($newData['pcpName'], $keyArray) ?$pcpArray[$newData['pcpName']]:$newData['pcpName'])}}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>{{($oldData['lStatus'] != '')?$leadStatus[$oldData['lStatus']]:''}}</td>
                                    <td>{{($newData['lStatus'] != '')?$leadStatus[$newData['lStatus']]:''}}</td>
                                </tr>
                                <tr>
                                    <td>Created By</td>
                                    <td>{{($createBy != '')?$createBy['first_name'].' '.$createBy['last_name']:''}}</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Updated By</td>
                                    <td>-</td>
                                    <td>{{($updateBy != '')?$updateBy['first_name'].' '.$updateBy['last_name']:''}}</td>
                                </tr>
                            @endforeach
                            @elseif($log_view_type == 'provider')
                                @foreach($logData as $val)
                                    @php 
                                        $oldData = json_decode($val->old_data,true);
                                        $newData = json_decode($val->new_data,true);
                                    @endphp
                                    <tr>
                                        <td>Name</td>
                                        <td>{{$oldData['first_name'].' '.$oldData['last_name']}}</td>
                                        <td>{{$newData['fName'].' '.$newData['lName']}}</td>
                                    </tr>
                                    <tr>
                                        <td>NPI</td>
                                        <td>{{($oldData['npi'] != '')?$oldData['npi']:''}}</td>
                                        <td>{{($newData['npi'] != '')?$newData['npi']:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Credentials</td>
                                        <td>{{($oldData['type'] != '')?$oldData['type']:''}}</td>
                                        <td>{{($newData['cred'] != '')?$newData['cred']:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Primary Speciality</td>
                                        <td>{{($oldData['primary_speciality'] != '')?$oldData['primary_speciality']:''}}</td>
                                        <td>{{($newData['spec'] != '')?$newData['spec']:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Language</td>
                                        @php 
                                            $newLang = unserialize($newData['lang']); 
                                            $oldLang = unserialize($oldData['lang']); 
                                            $newLangArray = $newOldArray = array();
                                            if(!empty($newLang)){
                                                $newLangArray = array_filter(array_map(
                                                      function ($v, $v1) { 
                                                            if($v != ''){
                                                               return $v1; 
                                                            }
                                                        }, 
                                                        array_values($newLang), 
                                                        array_values($lang)
                                                    ));
                                            }
                                            if(!empty($oldLang)){
                                                $newOldArray = array_filter(array_map(
                                                      function ($v, $v1) { 
                                                            if($v != ''){
                                                               return $v1; 
                                                            }
                                                        }, 
                                                        array_values($oldLang), 
                                                        array_values($lang)
                                                    ));
                                            }
                                        @endphp
                                        <td>{{($oldData['lang'] != '')?((!empty($newOldArray))?implode(",",$newOldArray):''):''}}</td>
                                        <td>{{($newData['lang'] != '')?((!empty($newLangArray))?implode(",",$newLangArray):''):''}}</td>
                                    </tr>
                                @endforeach
                            @elseif($log_view_type == 'center')
                                @foreach($logData as $val)
                                    @php 
                                        $oldData = json_decode($val->old_data,true);
                                        $newData = json_decode($val->new_data,true);
                                    @endphp
                                    <tr>
                                        <td>Center Name</td>
                                        <td>{{($oldData['centerName'] != '')?$oldData['centerName']:''}}</td>
                                        <td>{{($newData['centerName'] != '')?$newData['centerName']:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Address 1</td>
                                        <td>{{($oldData['inputAddress'] != '')?$oldData['inputAddress']:''}}</td>
                                        <td>{{($newData['inputAddress'] != '')?$newData['inputAddress']:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Address 2</td>
                                        <td>{{($oldData['inputAddress2'] != '')?$oldData['inputAddress2']:''}}</td>
                                        <td>{{($newData['inputAddress2'] != '')?$newData['inputAddress2']:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>City Name</td>
                                        <td>{{($oldData['inputCity'] != '')?$oldData['inputCity']:''}}</td>
                                        <td>{{($newData['inputCity'] != '')?$newData['inputCity']:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>State Name</td>
                                        <td>{{($oldData['inputState'] != '')?$oldData['inputState']:''}}</td>
                                        <td>{{($newData['inputState'] != '')?$newData['inputState']:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Zip Code</td>
                                        <td>{{($oldData['inputZip'] != '')?$oldData['inputZip']:''}}</td>
                                        <td>{{($newData['inputZip'] != '')?$newData['inputZip']:''}}</td>
                                    </tr>
                                    @php
                                        $oldPhone = $newPhone = $oldFax = $newFax =  0 ;
                                        $phone_old = (strpos($oldData['phone1'] , '(') !== false || strpos($oldData['phone1'] , ')') !== false)?$oldData['phone1'] :('('.substr($oldData['phone1'],0,3).') '.substr($oldData['phone1'],3,3)."-".substr($oldData['phone1'],6,4));
                                        $phone_new = (strpos($newData['phone1'] , '(') !== false || strpos($newData['phone1'] , ')') !== false)?$newData['phone1'] :('('.substr($newData['phone1'],0,3).') '.substr($newData['phone1'],3,3)."-".substr($newData['phone1'],6,4));
                                        $fax_old = (strpos($oldData['fax1'] , '(') !== false || strpos($oldData['fax1'] , ')') !== false)?$oldData['fax1'] :('('.substr($oldData['fax1'],0,3).') '.substr($oldData['fax1'],3,3)."-".substr($oldData['fax1'],6,4));
                                        $fax_new = (strpos($newData['fax1'] , '(') !== false || strpos($newData['fax1'] , ')') !== false)?$newData['fax1'] :('('.substr($newData['fax1'],0,3).') '.substr($newData['fax1'],3,3)."-".substr($newData['fax1'],6,4));
                                    @endphp
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{($oldData['phone1'] != '')?$phone_old:''}}</td>
                                        <td>{{($newData['phone1'] != '')?$phone_new:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Fax</td>
                                        <td>{{($oldData['fax1'] != '')?$fax_old:''}}</td>
                                        <td>{{($newData['fax1'] != '')?$fax_new:''}}</td>
                                    </tr>
                                @endforeach 
                                @elseif($log_view_type == 'user')
                                    @php 
                                        $userStatus = array(0=>'Unlock',1=>'Lock');
                                    @endphp
                                    @foreach($logData as $val)
                                    @php 
                                        $oldData = json_decode($val->old_data,true);
                                        $newData = json_decode($val->new_data,true);
                                    @endphp
                                    <tr>
                                        <td>Name</td>
                                        <td>{{$oldData['first_name'].' '.$oldData['last_name']}}</td>
                                        <td>{{$newData['first_name'].' '.$newData['last_name']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{($oldData['email'] != '')?$oldData['email']:''}}</td>
                                        <td>{{($newData['email'] != '')?$newData['email']:''}}</td>
                                    </tr>
                                    @php
                                        $oldPhone = $newPhone = 0 ;
                                        $phone_old = (strpos($oldData['phone_number'] , '(') !== false || strpos($oldData['phone_number'] , ')') !== false)?$oldData['phone_number'] :('('.substr($oldData['phone_number'],0,3).') '.substr($oldData['phone_number'],3,3)."-".substr($oldData['phone_number'],6,4));
                                        $phone_new = (strpos($newData['phone_number'] , '(') !== false || strpos($newData['phone_number'] , ')') !== false)?$newData['phone_number'] :('('.substr($newData['phone_number'],0,3).') '.substr($newData['phone_number'],3,3)."-".substr($newData['phone_number'],6,4));
                                    @endphp
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{($oldData['phone_number'] != '')?$phone_old:''}}</td>
                                        <td>{{($newData['phone_number'] != '')?$phone_new:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>{{$userStatus[$oldData['status']]}}</td>
                                        <td>{{$userStatus[$newData['status']]}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
</div>