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

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(Auth::user()->hasRole('agent-user')){
            $doctors = DoctorsAgent::where('agent_id', Auth::user()->id)->pluck('doctor_id');
            $leads = Lead::whereIn('pcpName',$doctors)->orWhere('agent',Auth::user()->id)->get()->toArray();
        }else{
            $leads = Lead::all()->toArray();
        }
        return view('leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Doctors::get();
        $state = State::get();
        return view('leads\newLead', compact('doctors','state'));
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
        if(!array_key_exists('agent',$data) || $request->agent == '' ){
            $data['agent'] = NULL;
            $data['lStatus'] = 2;
        }
        if(array_key_exists('id',$data)){
            unset($data['_token']);
            unset($data['agent_id']);
            unset($data['uploadDocs']);
            Lead::where('id',$data['id'])->update($data);
        }else{
            $last_id  = Lead::create($data);

            $lead_details = Lead::find($last_id->id);

            if (!empty($lead_details->agent) && $lead_details->agreeOrDisagree == 1) {
                $lead_details->lStatus = 1;
                $lead_details->save();
            } else if ($lead_details->agreeOrDisagree == 2) {
                $lead_details->lStatus = 4;
                $lead_details->save();
            }
            if (!empty($lead_details->agent)) {
                $getAgentEmail = User::where('id',$lead_details->agent)->select('email')->first();
                $getDoc = Doctors::where('id',$lead_details->pcpName)->select('last_name','first_name','type')->first();
                    if(!empty($getAgentEmail)){
                        $data = [
                            'formData' => $lead_details,
                            'doctor' => $getDoc,
                            'from' => 'test.devhealth@gmail.com',
                            'to'    => $getAgentEmail->email,
                            'cc'    => 'rmatos@devhealth.net'
//                            'to'    => 'poojaatridhyatech@gmail.com',
//                            'cc'    => 'poojaatridhyatech@gmail.com'
                        ];
                        \Mail::send('emails.addLead', ['data' => $data], function ($message) use ($data) {
                            $message->from($data['from'])->to($data['to'])->cc($data['cc'])->subject('New Lead Added');
                        });
                    }
            }
        }


        // return redirect()->route('lead.view');
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
        $lead_details = Lead::find($request->lead_id);
        $doctors = Doctors::get();
        $agents = RoleUser::where('role_id',2)->pluck('user_id');
        $agent_details = User::whereIn('id',$agents)->get();
//       if(!Auth::user()->hasRole('agent-user')){
//        return view('leads.editLead', compact('lead_details', 'doctors','agent_details'));
//       }else{
        $state = State::get();
        return view('leads.agentLead', compact('lead_details', 'doctors','agent_details','state'));
//       }
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
}
