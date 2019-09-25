<?php

namespace App\Http\Controllers;

use App\Doctors;
use App\DoctorsAgent;
use App\Lead;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpseclib\System\SSH\Agent;

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
            $leads = Lead::where('agent',Auth::user()->id)->get()->toArray();
        }else{
            $leads = Lead::all()->toArray();
        }
        return view('leads.index', compact('leads', 'dashboard'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Doctors::get();
        return view('leads\newLead', compact('doctors'));
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

        $last_id  = Lead::create($data);

        $lead_details = Lead::find($last_id->id);

        if (!empty($lead_details->agent) && $lead_details->agreeOrDisagree == 1) {
            $lead_details->lStatus = 1;
            $lead_details->save();
        } else if ($lead_details->agreeOrDisagree == 2) {
            $lead_details->lStatus = 4;
            $lead_details->save();
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
    public function edit(Lead $lead)
    {
        //
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
        $agents = DoctorsAgent::where('doctor_id', $request->doctor_id)->pluck('agent_id');
        $agent_details = User::whereIn('id', $agents)->get();
        echo view('leads.doctor_agent', compact('agent_details'))->render();
    }
}
