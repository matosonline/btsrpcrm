<?php

namespace App\Http\Controllers;

use App\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DoctorsAgent;


class DashboardController extends Controller
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
        
        $totalLeads = Lead::orderBy('created_at', 'DESC')->get()->toArray();
        $closeLeads = Lead::where('lStatus',3)->get()->toArray();
        $newLeads = Lead::where('lStatus',1)->get()->toArray();
        $totalOptedOut = Lead::where('agreeOrDisagree',2)->get()->toArray();
        return view('/dashboard', compact('leads','totalLeads','closeLeads','newLeads','totalOptedOut'));
    }
}
