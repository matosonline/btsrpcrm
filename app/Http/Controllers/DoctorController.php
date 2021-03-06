<?php

namespace App\Http\Controllers;

use App\Doctors;
use App\DoctorsAgent;
use App\Lead;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpseclib\System\SSH\Agent;
use Illuminate\Support\Facades\Mail;
use App\State;
use App\InsuranceType;
use App\DoctorInsurance;
use App\Specialties;
use App\Traits\LogData;
use App\Log;
use Illuminate\Support\Facades\Redirect;
use Alert;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use LogData;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
            $doctors = Doctors::orderBy('id','DESC')->get()->toArray();
            return view('providers.index', compact('doctors'));
        }else{
            Alert::error('You do not have permission to perform this action!')->persistent('Close');
            return Redirect::to('dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasRole('Admin')) {
            $state = State::get();
            $insuranceType = InsuranceType::get();
            $specialties = Specialties::get();
            return view('providers.newProvider',compact('state','insuranceType','specialties'));
        }else{
            Alert::error('You do not have permission to perform this action!')->persistent('Close');
            return Redirect::to('dashboard');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
                'fName' => 'required',
                'lName' => 'required',
                'npi' => 'required',
                'cred' => 'required',
                'spec' => 'required',
                'phone1' => 'required',
                'email' => 'required',
                'startDate1'=>'required_with:1_Check',
                'startDate2'=>'required_with:2_Check',
                'startDate3'=>'required_with:3_Check',
                'startDate4'=>'required_with:4_Check',
        ]);
        $data = $request->all();
        $data['dob'] =  ($data['dob'] != '')?date("Y-m-d", strtotime($data['dob'])):NULL;
        $phoneNum =  ($data['phone1'])?str_replace(' ', '', str_replace(str_split('\\/:*?"<>()-|'),'',$data['phone1'])):NULL;
        if(array_key_exists('id',$data)){
            $oldData = $obj = Doctors::find($data['id']);
            $oldData = clone $obj;
        }else{
            $obj = new Doctors();
        }
        $obj->first_name = ($data['fName'] != '')?$data['fName']:NULL;
        $obj->last_name = ($data['lName'] != '')?$data['lName']:NULL;
        $obj->dob    =  ($data['dob'] != '')?$data['dob']:NULL;
        $obj->npi    = ($data['npi'] != '')?$data['npi']:NULL;
        $obj->ssn    = ($data['ssn'] != '')?$data['ssn']:NULL;
        $obj->type    = ($data['cred'] != '')?$data['cred']:NULL;
        $obj->primary_speciality    = ($data['spec'] != '')?$data['spec']:NULL;
        $obj->lang    = (array_key_exists('lang',$data) && $data['lang'] != '')?serialize($data['lang']):NULL;
        $obj->address1    = ($data['inputAddress'] != '')?$data['inputAddress']:NULL;
        $obj->inputAddress2    = ($data['inputAddress2'] != '')?$data['inputAddress2']:NULL;
        $obj->inputCity    = ($data['inputCity'] != '')?$data['inputCity']:NULL;
        $obj->inputState    = ($data['inputState'] != '')?$data['inputState']:NULL;
        $obj->inputZip    = ($data['inputZip'] != '')?$data['inputZip']:NULL;
        $obj->email    = ($data['email'] != '')?$data['email']:NULL;
        $obj->phone1    = ($data['phone1'] != '')?$phoneNum:NULL;
        $obj->notes    = ($data['notes'] != '')?$data['notes']:NULL;
        $obj->save();
        $lastInsertId = $obj->id;
        $insuranceType = InsuranceType::get();
        
        if(array_key_exists('id',$data)){
            $data['lang'] = serialize($data['lang']);
            $new_data = json_encode($data);
            $old_data = json_encode($oldData);
            $this->insertLog($data['id'],'Edit Provider',$old_data,$new_data);
        }else{
            $new_data = json_encode($data);
            $this->insertLog($lastInsertId,'Add Provider','',$new_data);
        }
        
        if($lastInsertId != ''){
            foreach($insuranceType as $val){
                $fieldName = $val['id'].'_Check';
                if(array_key_exists($fieldName,$data)){
                    
                    $checkExist = DoctorInsurance::where('doctor_id',$lastInsertId)->where('insurance_type_id',$val['id'])->first();
                    if($checkExist){
                        $insType = DoctorInsurance::find($checkExist['id']);
                    }else{
                        $insType = new DoctorInsurance();
                    }
                    $insType->doctor_id	= $lastInsertId;
                    $insType->insurance_type_id	= $val['id'];
                    $insType->start_date	= ($data['startDate'.$val['id']] != '')?date("Y-m-d", strtotime($data['startDate'.$val['id']])):NULL;
                    $insType->end_date	= ($data['termDate'.$val['id']] != '')?date("Y-m-d", strtotime($data['termDate'.$val['id']])):NULL;
                    $insType->save();
                }
            }
        }
        return redirect()->back()->with('message', 'Record Updated!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if (Auth::user()->hasRole('Admin')) {
            $doctors_details = Doctors::with('doctorInsuranceType')->find($request->provider_id);
            $doctors_insur = DoctorInsurance::where('doctor_id',$request->provider_id)->get();
            $state = State::get();
            $insuranceType = InsuranceType::get();
            $specialties = Specialties::get();
            return view('providers.editProvider', compact('doctors_details','state','insuranceType','specialties','doctors_insur'));
        }else{
            Alert::error('You do not have permission to perform this action!')->persistent('Close');
            return Redirect::to('dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        //
    }
    
    
}
