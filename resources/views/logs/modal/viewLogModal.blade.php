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
                                    $updateBy = $createBy = '';
                                    $oldData = ($val->old_data != '')?json_decode($val->old_data,true):'';
                                    $newData = ($val->new_data != '')?json_decode($val->new_data,true):'';
                                    if($oldData != ''){
                                        $createBy = ($oldData['created_by'] != '')?(new \App\Helpers\CommonHelper)->getNameById($oldData['created_by']):'';
                                        $updateBy = ($newData['updated_by'] != '')?(new \App\Helpers\CommonHelper)->getNameById($newData['updated_by']):'';
                                    }
                                @endphp
                                <tr>
                                    <td>Name</td>
                                    <td>{{($oldData != '')?$oldData['fName'].' '.$oldData['lName']:''}}</td>
                                    <td>{{($newData != '')?$newData['fName'].' '.$newData['lName']:''}}</td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>{{($oldData != '')?$oldData['phone1'].' '.$oldData['phone1']:''}}</td>
                                    <td>{{($newData != '')?$newData['phone1'].' '.$newData['phone1']:''}}</td>
                                </tr>
                                <tr>
                                    <td>Language</td>
                                    <td>{{($oldData != '')?$lang[$oldData['lang']]:''}}</td>
                                    <td>{{($newData != '')?$lang[$newData['lang']]:''}}</td>
                                </tr>
                                <tr>
                                    <td>Agree/Disagree</td>
                                    <td>{{($oldData != '' && isset($oldData['agreeOrDisagree']))?$agreeStatus[$oldData['agreeOrDisagree']]:''}}</td>
                                    <td>{{($newData != '' && isset($newData['agreeOrDisagree']))?$agreeStatus[$newData['agreeOrDisagree']]:''}}</td>
                                </tr>
                                <tr>
                                    <td>Play Type</td>
                                    <td>{{($oldData != '' && isset($oldData['planType']))?$planType[$oldData['planType']]:''}}</td>
                                    <td>{{($newData != '' && isset($newData['planType']))?$planType[$newData['planType']]:''}}</td>
                                </tr>
                                <tr>
                                    <td>Inquire Type</td>
                                    <td>{{($oldData != '' && isset($oldData['inquire_type']))?$inquireType[$oldData['inquire_type']]:''}}</td>
                                    <td>{{($newData != '' && isset($newData['inquire_type']))?$inquireType[$newData['inquire_type']]:''}}</td>
                                </tr>
                                <tr>
                                    <td>PCP Name</td>
                                    <td>{{($oldData != '')?(in_array($oldData['pcpName'], $keyArray) ?$pcpArray[$oldData['pcpName']]:$oldData['pcpName']):''}}</td>
                                    <td>{{($newData != '')?(in_array($newData['pcpName'], $keyArray) ?$pcpArray[$newData['pcpName']]:$newData['pcpName']):''}}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>{{($oldData != '')?$leadStatus[$oldData['lStatus']]:''}}</td>
                                    <td>{{($newData != '')?$leadStatus[$newData['lStatus']]:''}}</td>
                                </tr>
                                <tr>
                                    <td>Created By</td>
                                    <td>{{($createBy != '')?$createBy['first_name'].' '.$createBy['last_name']:''}}</td>
                                    <td>{{($createBy != '')?$createBy['first_name'].' '.$createBy['last_name']:''}}</td>
                                </tr>
                                <tr>
                                    <td>Updated By</td>
                                    <td>{{($updateBy != '')?$updateBy['first_name'].' '.$updateBy['last_name']:''}}</td>
                                    <td>{{($updateBy != '')?$updateBy['first_name'].' '.$updateBy['last_name']:''}}</td>
                                </tr>
                            @endforeach
                            @elseif($log_view_type == 'provider')
                                @foreach($logData as $val)
                                    @php 
                                         $oldData = ($val->old_data != '')?json_decode($val->old_data,true):'';
                                         $newData = ($val->new_data != '')?json_decode($val->new_data,true):'';
                                    @endphp
                                    <tr>
                                        <td>Name</td>
                                        <td>{{($oldData != '')?$oldData['first_name'].' '.$oldData['last_name']:''}}</td>
                                        <td>{{($newData != '')?$newData['fName'].' '.$newData['lName']:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>NPI</td>
                                        <td>{{($oldData != '')?$oldData['npi']:''}}</td>
                                        <td>{{($newData != '')?$newData['npi']:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Credentials</td>
                                        <td>{{($oldData != '')?$oldData['type']:''}}</td>
                                        <td>{{($newData != '')?$newData['cred']:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Primary Speciality</td>
                                        <td>{{($oldData != '')?$oldData['primary_speciality']:''}}</td>
                                        <td>{{($newData != '')?$newData['spec']:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Language</td>
                                        @php 
                                            $newLangArray = $newOldArray = array();
                                            if($oldData != ''){
                                                $oldLang = unserialize($oldData['lang']); 
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
                                            }
                                            if($newData != ''){
                                                $newLang = unserialize($newData['lang']); 
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
                                        }
                                        @endphp
                                        <td>{{($oldData != '')?((!empty($newOldArray))?implode(",",$newOldArray):''):''}}</td>
                                        <td>{{($newData != '')?((!empty($newLangArray))?implode(",",$newLangArray):''):''}}</td>
                                    </tr>
                                @endforeach
                            @elseif($log_view_type == 'center')
                                @foreach($logData as $val)
                                    @php 
                                        $oldData = ($val->old_data != '')?json_decode($val->old_data,true):'';
                                        $newData = ($val->new_data != '')?json_decode($val->new_data,true):'';
                                    @endphp
                                    <tr>
                                        <td>Center Name</td>
                                        <td>{{($oldData != '')?$oldData['centerName']:''}}</td>
                                        <td>{{($newData != '')?$newData['centerName']:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Address 1</td>
                                        <td>{{($oldData != '')?$oldData['inputAddress']:''}}</td>
                                        <td>{{($newData != '')?$newData['inputAddress']:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Address 2</td>
                                        <td>{{($oldData != '')?$oldData['inputAddress2']:''}}</td>
                                        <td>{{($newData != '')?$newData['inputAddress2']:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>City Name</td>
                                        <td>{{($oldData != '')?$oldData['inputCity']:''}}</td>
                                        <td>{{($newData != '')?$newData['inputCity']:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>State Name</td>
                                        <td>{{($oldData != '')?$oldData['inputState']:''}}</td>
                                        <td>{{($newData != '')?$newData['inputState']:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Zip Code</td>
                                        <td>{{($oldData != '')?$oldData['inputZip']:''}}</td>
                                        <td>{{($newData != '')?$newData['inputZip']:''}}</td>
                                    </tr>
                                    @php
                                        $oldPhone = $newPhone = $oldFax = $newFax =  0 ;
                                        $phone_old = $fax_old = $phone_new = $fax_new ='';
                                        if($oldData != ''){
                                            $phone_old = (strpos($oldData['phone1'] , '(') !== false || strpos($oldData['phone1'] , ')') !== false)?$oldData['phone1'] :('('.substr($oldData['phone1'],0,3).') '.substr($oldData['phone1'],3,3)."-".substr($oldData['phone1'],6,4));
                                            $fax_old = (strpos($oldData['fax1'] , '(') !== false || strpos($oldData['fax1'] , ')') !== false)?$oldData['fax1'] :('('.substr($oldData['fax1'],0,3).') '.substr($oldData['fax1'],3,3)."-".substr($oldData['fax1'],6,4));
                                        }
                                        if($newData != ''){
                                            $phone_new = (strpos($newData['phone1'] , '(') !== false || strpos($newData['phone1'] , ')') !== false)?$newData['phone1'] :('('.substr($newData['phone1'],0,3).') '.substr($newData['phone1'],3,3)."-".substr($newData['phone1'],6,4));
                                            $fax_new = (strpos($newData['fax1'] , '(') !== false || strpos($newData['fax1'] , ')') !== false)?$newData['fax1'] :('('.substr($newData['fax1'],0,3).') '.substr($newData['fax1'],3,3)."-".substr($newData['fax1'],6,4));
                                        }
                                    @endphp
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{($oldData != '')?$phone_old:''}}</td>
                                        <td>{{($newData != '')?$phone_new:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Fax</td>
                                        <td>{{($oldData != '')?$fax_old:''}}</td>
                                        <td>{{($newData != '')?$fax_new:''}}</td>
                                    </tr>
                                @endforeach 
                                @elseif($log_view_type == 'user')
                                    @php 
                                        $userStatus = array(0=>'Unlock',1=>'Lock');
                                    @endphp
                                    @foreach($logData as $val)
                                    @php 
                                        $oldData = ($val->old_data != '')?json_decode($val->old_data,true):'';
                                        $newData = ($val->new_data != '')?json_decode($val->new_data,true):'';
                                    @endphp
                                    <tr>
                                        <td>Name</td>
                                        <td>{{($oldData != '')?$oldData['first_name'].' '.$oldData['last_name']:''}}</td>
                                        <td>{{($oldData != '')?$newData['first_name'].' '.$newData['last_name']:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{($oldData != '')?$oldData['email']:''}}</td>
                                        <td>{{($newData != '')?$newData['email']:''}}</td>
                                    </tr>
                                    @php
                                        $oldPhone = $newPhone = 0;
                                        $phone_new = $phone_old = '';
                                        if($oldData != ''){
                                            $phone_old = (strpos($oldData['phone_number'] , '(') !== false || strpos($oldData['phone_number'] , ')') !== false)?$oldData['phone_number'] :('('.substr($oldData['phone_number'],0,3).') '.substr($oldData['phone_number'],3,3)."-".substr($oldData['phone_number'],6,4));
                                        }if($newData != ''){
                                            $phone_new = (strpos($newData['phone_number'] , '(') !== false || strpos($newData['phone_number'] , ')') !== false)?$newData['phone_number'] :('('.substr($newData['phone_number'],0,3).') '.substr($newData['phone_number'],3,3)."-".substr($newData['phone_number'],6,4));
                                        }
                                    @endphp
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{($oldData != '')?$phone_old:''}}</td>
                                        <td>{{($newData != '')?$phone_new:''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>{{($oldData != '')?$userStatus[$oldData['status']]:''}}</td>
                                        <td>{{($oldData != '')?$userStatus[$newData['status']]:''}}</td>
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