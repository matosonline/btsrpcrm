<?php

namespace App\Http\Controllers;

use App\Doctors;
use App\DoctorsAgent;
use App\Lead;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpseclib\System\SSH\Agent;
use Illuminate\Support\Facades\Mail;
use App\State;
use App\LeadDetail;
use App\Log;
use App\Traits\LogData;
use App\Prospects;
use App\Note;
use Illuminate\Support\Facades\Redirect;
use Alert;

class LeadController extends Controller
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
    public function index(Request $request)
    {
        if(isset($request['status']) && $request['status'] != ''){
            $descStatus = decrypt($request['status']);
            $leads = new Lead();
            if($descStatus == 'unassigned'){
                $leads = $leads->whereNull('agent');
            }elseif($descStatus == 1){
                $leads = $leads->where('lStatus',1);
            }elseif($descStatus == 4){
                $leads = $leads->where('lStatus', 4);
            }elseif($descStatus == 'optedOut'){
                $leads = $leads->where('agreeOrDisagree',2);
            }elseif($descStatus == 3){
                $leads = $leads->where('lStatus',3);
            }
            if(Auth::user()->hasRole('agent-user')){
                $doctors = DoctorsAgent::where('agent_id', Auth::user()->id)->pluck('doctor_id');
                $leads = $leads->Where(function($t)use($doctors){
                                    $t->where('created_by', Auth::user()->id);
                                    $t->orwhere(function($q)use($doctors) {
                                        $q->whereIn('pcpName',$doctors)
                                        ->orWhere('agent',Auth::user()->id);
                                    });
                            });
            }
            
        }else{
            if(Auth::user()->hasRole('agent-user')){
                $doctors = DoctorsAgent::where('agent_id', Auth::user()->id)->pluck('doctor_id');
                $leads =  Lead::Where(function($t)use($doctors){
                            $t->where('created_by', Auth::user()->id);
                            $t->orwhere(function($q)use($doctors) {
                                $q->whereIn('pcpName',$doctors)
                                ->orWhere('agent',Auth::user()->id);
                            });
                        });
            }else{
                $leads = new Lead();
            }
        }
        $leads = $leads->orderBy('id','DESC')->get()->toArray();
        return view('leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $doctors = Doctors::get();
        $state = State::get();
        
        $prospectData = Prospects::get();
        $NameOfProspect = array();
        foreach($prospectData as $val){
            $NameOfProspect[$val['id']] = $val['PatientFirstName'].' '.$val['PatientLastName'].' - '.$val['DOB'];
        }
        $getProspectData = '';
        if ($request->has('prospectSearchName') && $request->prospectSearchName != '') {
            $getProspectData = Prospects::where('id',  '=', $request->prospectSearchName)->first();
        }
        return view('leads.newLead', compact('doctors','state','NameOfProspect','getProspectData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        
        $data['dob'] =  ($data['dob'] != '')?date("Y-m-d", strtotime($data['dob'])):NULL;
        $data['phone1'] =  ($data['phone1'])?str_replace(' ', '', str_replace(str_split('\\/:*?"<>()-|'),'',$data['phone1'])):NULL;
         $validatedData = $request->validate([
                'uploadDocs.*' => 'mimes:pdf,jpg,jpeg'
                ]);
        if(array_key_exists('id',$data)){
            $data['startDate'] =  ($data['startDate'])?date("Y-m-d", strtotime($data['startDate'])):NULL;
            $data['updated_by'] = Auth::user()->id;
            $data['appointmentDate'] =  ($data['appointmentDate'])?date("Y-m-d", strtotime($data['appointmentDate'])):NULL;
            unset($data['_token']);
            unset($data['agent_id']);
            unset($data['uploadDocs']);
            unset($data['appointmentDateHidden']);
            unset($data['pcpOtherHidden']);
            if($data['pcpName'] == 0){
                $data['pcpName'] = $data['pcp_other'];
            }
            unset($data['pcp_other']);
            $leadId = $data['id'];
            $getOldData = Lead::where('id',$data['id'])->first();
            $updateLead = Lead::where('id',$data['id'])->update($data);
            
            if($getOldData['agent'] != $data['agent'] && $data['agent'] != ''){
                if (!empty($data['agent'])) {
                    $getAgentEmail = User::where('id',$data['agent'])->select('email','last_name','first_name')->first();
                    $getDoc = Doctors::where('id',$data['pcpName'])->select('last_name','first_name','type')->first();
                        if(!empty($getAgentEmail)){
                             $this->leadEmail($getOldData,$getAgentEmail,$getDoc);
                        }
                }else{
                    $doctorsAgent = DoctorsAgent::where('doctor_id',$data['pcpName'])->select('agent_id')->get();
                    foreach($doctorsAgent as $val){
                        $getAgentEmail = User::where('id',$val->agent_id)->select('email','last_name','first_name')->first();
                        $getDoc = Doctors::where('id',$data['pcpName'])->select('last_name','first_name','type')->first();
                        if(!empty($getAgentEmail)){
                            $this->leadEmail($getOldData,$getAgentEmail,$getDoc);
                        }
                    }
                }
            }

            $old_data = json_encode($getOldData);
            $new_data = json_encode($data);
            $this->insertLog($data['id'],'Edit Lead',$old_data,$new_data);
        }else{
            if(!array_key_exists('agent',$data) || $request->agent == '' ){
                $data['agent'] = NULL;
                $data['lStatus'] = 1;
            }
            $data['created_by'] = Auth::user()->id;
            unset($data['uploadDocs']);
            if($data['pcpName'] == 0){
                $data['pcpName'] = $data['pcp_other'];
            }
            unset($data['pcp_other']);
            $last_id  = Lead::create($data);
            $lead_details = Lead::find($last_id->id);

            if (!empty($lead_details->agent) && $lead_details->agreeOrDisagree == 1) {
                $lead_details->lStatus = 1;
                $lead_details->save();
            } else if ($lead_details->agreeOrDisagree == 2) {
                $lead_details->lStatus = 4;
                $lead_details->save();
            }
            
                        
            //For customer Mail
            if(!empty($lead_details->email)){
                $this->custLeadEmail($lead_details->email);
            }
            // For agent mail
            if (!empty($lead_details->agent)) {
                $getAgentEmail = User::where('id',$lead_details->agent)->select('email','last_name','first_name')->first();
                $getDoc = Doctors::where('id',$lead_details->pcpName)->select('last_name','first_name','type')->first();
                    if(!empty($getAgentEmail)){
                        $this->leadEmail($lead_details,$getAgentEmail,$getDoc);
                    }
            }else{
                $doctorsAgent = DoctorsAgent::where('doctor_id',$lead_details->pcpName)->select('agent_id')->get();
                foreach($doctorsAgent as $val){
                    $getAgentEmail = User::where('id',$val->agent_id)->select('email','last_name','first_name')->first();
                    $getDoc = Doctors::where('id',$lead_details->pcpName)->select('last_name','first_name','type')->first();
                    if(!empty($getAgentEmail)){
                        $this->leadEmail($lead_details,$getAgentEmail,$getDoc);
                    }
                }
            }
            $leadId = $lead_details->id;
            $new_data = json_encode($data);
            $this->insertLog($lead_details->id,'Add Lead','',$new_data);
        }
        //store note for Add/Edit lead
        if($data['notes'] != ''){
            $note = ($data['notes'] != '')?$data['notes']: '';
            $userId = Auth::user()->id;
            $type = '1';
            $typeId = $leadId;
            $this->saveNote($note, $userId, $type, $typeId);
        }
        
        // Continue in file upload
            if(isset($request['uploadDocs']))
            {
                if(count($request['uploadDocs'])>0){
                    $allowedfileExtension=['pdf','jpg','jpeg'];
                    $files = $request['uploadDocs'];
                    foreach($files as $file){
                        $filename = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $check=in_array($extension,$allowedfileExtension);
                        if($check)
                        {
                            $destinationPath = public_path().'\storage\app\leadDoc'; 
                            $newFileName = date('Ydm').time().'['.$leadId.']'.$filename;

                            $file->move($destinationPath, $newFileName);
                            LeadDetail::create([
                                'lead_id' => $leadId,
                                'filename' => $newFileName
                            ]);
                        }
                    }
                }
            }
        // return redirect()->route('lead.view');
        return redirect()->back()->with('message', 'Record Updated!');
    }
    
    public function custLeadEmail($customerMail) {
        $data = [
                'from' => 'test.devhealth@gmail.com',
                'to'    => $customerMail
            ];
        \Mail::send('emails.addLeadUser', ['data' => $data], function ($message) use ($data) {
            $message->from($data['from'])->to($data['to'])->subject('Thanks for joining us');
        });

    }
    public function leadEmail($lead_details,$getAgentEmail,$getDoc) {
        $getManagerData = RoleUser::leftjoin('users','role_user.user_id','users.id')->where('role_user.role_id',5)->select('users.email')->get();
        $ccArray = array();
        if(!$getManagerData->isEmpty()){
            foreach($getManagerData as $val){
                $ccArray[] = $val->email;
            }
        }
        $data = [
                'formData' => $lead_details,
                'getAgentData'=>$getAgentEmail,
                'doctor' => $getDoc,
                'from' => 'test.devhealth@gmail.com',
                'to'    => $getAgentEmail->email,
                'cc'    => $ccArray
//               'cc'    => 'rmatos@devhealth.net'
//                'to'    => 'poojaatridhyatech@gmail.com',
            ];
        \Mail::send('emails.addLead', ['data' => $data], function ($message) use ($data) {
            $message->from($data['from'])->to($data['to'])->cc($data['cc'])->subject('New Lead Added');
        });
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
        $lead_details = Lead::find($request->lead_id);
        $doctors = Doctors::get();
        $agents = RoleUser::where('role_id',2)->pluck('user_id');
        $agent_details = User::whereIn('id',$agents)->get();
//       if(!Auth::user()->hasRole('agent-user')){
//        return view('leads.editLead', compact('lead_details', 'doctors','agent_details'));
//       }else{
//       }
        $state = State::get();
        $getAttachment = LeadDetail::where('lead_id',$request->lead_id)->get();
        $notes = Note::leftjoin('users','notes.user_id','users.id')
                    ->where('notes.type',1)
                    ->where('notes.type_id',$request->lead_id)
                    ->orderBy('notes.note_date','DESC')->get();
        $notes = $notes->reverse();

        return view('leads.agentLead', compact('lead_details', 'doctors','agent_details','state','getAttachment','notes'));
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
        //
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
    public function get_agents(Request $request)
    {
        if($request->doctor_id == '' || $request->doctor_id == 0){
            $agents = RoleUser::where('role_id',2)->pluck('user_id');
        }else{
            $agents = DoctorsAgent::where('doctor_id', $request->doctor_id)->pluck('agent_id');
        }
        $agent_details = User::whereIn('id', $agents)->get();
        echo view('leads.doctor_agent', compact('agent_details'))->render();
    }
    public function delete_attach(Request $request) {
        $attachId = $request->attachId;
        LeadDetail::where('id',$attachId)->delete();
    }
    
    public function saveNote($note_text,$userId,$type,$typeId){
        $note = new Note();
        $note->notes = $note_text;
        $note->user_id = $userId;
        $note->type = $type;
        $note->type_id = $typeId;
        $note->note_date = date("Y-m-d H:i:s");
        $note->save();
    }
}
