<?php

namespace App\Http\Controllers;

use App\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DoctorsAgent;
use App\Prospects;
use App\Doctors;
use Illuminate\Support\Facades\Event;
use App\Center;
use App\Exports\LeadExport;
use Maatwebsite\Excel\Facades\Excel;

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
            $leads = Lead::Where(function($t)use($doctors){
                        $t->where('created_by', Auth::user()->id);
                        $t->orwhere(function($q)use($doctors) {
                            $q->whereIn('pcpName',$doctors)
                            ->orWhere('agent',Auth::user()->id);
                            });
                    })->get()->toArray();
        }else{
            $leads = Lead::orderBy('id','DESC')->get()->toArray();
        }
        
        $totalLeads = Lead::orderBy('created_at', 'DESC');
        $closeLeads = Lead::where('lStatus',3);
        $lostLeads = Lead::where('lStatus', 4);
        $newLeads = Lead::where('lStatus',1);
        $totalOptedOut = Lead::where('agreeOrDisagree',2);
        $totalUassigned = Lead::whereNull('agent');
        if(Auth::user()->hasRole('agent-user')){
            $totalLeads = $totalLeads->Where(function($t)use($doctors){
                                    $t->where('created_by', Auth::user()->id);
                                    $t->orwhere(function($q)use($doctors) {
                                        $q->whereIn('pcpName',$doctors)
                                        ->orWhere('agent',Auth::user()->id);
                                    });
                            });
            $closeLeads = $closeLeads->Where(function($t)use($doctors){
                                    $t->where('created_by', Auth::user()->id);
                                    $t->orwhere(function($q)use($doctors) {
                                        $q->whereIn('pcpName',$doctors)
                                        ->orWhere('agent',Auth::user()->id);
                                    });
                            });
            $lostLeads = $lostLeads->Where(function($t)use($doctors){
                                    $t->where('created_by', Auth::user()->id);
                                    $t->orwhere(function($q)use($doctors) {
                                        $q->whereIn('pcpName',$doctors)
                                        ->orWhere('agent',Auth::user()->id);
                                    });
                            });
            $newLeads = $newLeads->Where(function($t)use($doctors){
                                    $t->where('created_by', Auth::user()->id);
                                    $t->orwhere(function($q)use($doctors) {
                                        $q->whereIn('pcpName',$doctors)
                                        ->orWhere('agent',Auth::user()->id);
                                    });
                            });
            $totalOptedOut = $totalOptedOut->Where(function($t)use($doctors){
                                    $t->where('created_by', Auth::user()->id);
                                    $t->orwhere(function($q)use($doctors) {
                                        $q->whereIn('pcpName',$doctors)
                                        ->orWhere('agent',Auth::user()->id);
                                    });
                            });
            $totalUassigned = $totalUassigned->Where(function($t)use($doctors){
                                    $t->where('created_by', Auth::user()->id);
                                    $t->orwhere(function($q)use($doctors) {
                                        $q->whereIn('pcpName',$doctors)
                                        ->orWhere('agent',Auth::user()->id);
                                    });
                            });
        }
        $totalLeads = $totalLeads->get()->toArray();
        $closeLeads = $closeLeads->get()->toArray();
        $lostLeads = $lostLeads->get()->toArray();
        $newLeads = $newLeads->get()->toArray();
        $totalOptedOut = $totalOptedOut->get()->toArray();
        $totalUassigned = $totalUassigned->get()->toArray();

        return view('/dashboard', compact('leads','totalLeads','closeLeads','lostLeads','newLeads','totalOptedOut','totalUassigned'));
    }
    public function getAutocompleteData(Request $request) {
        $search = $request->get('term');
        $result = array();
        if($search != ''){
            $leadRes = Lead::where('fName', 'LIKE','%'.$search.'%')->orwhere('lName', 'LIKE','%'.$search.'%')->orwhere('dob', 'LIKE','%'.$search.'%')->get();
            if(!$leadRes->isempty()){
                foreach($leadRes as $val){
                    $result[] = array("value" => 'leadRes_'.$val['id'],"label"=> $val['fName'].' '.$val['lName'].' '.$val['dob'].' '.$val['inputAddress'].' '.$val['inputAddress2'].' '.$val['inputCity'].' '.$val['inputZip']);
                }
            }
            if(!Auth::user()->hasRole('agent-user')){
                $proRes = Prospects::where('PatientFirstName', 'LIKE','%'.$search.'%')->orwhere('PatientLastName', 'LIKE','%'.$search.'%')
                        ->orwhere('DOB', 'LIKE','%'.$search.'%')->get();
                if(!$proRes->isempty()){
                    foreach($proRes as $val){
                        $result[] = array("value" =>'proRes_'.$val['id'],"label"=> $val['PatientFirstName'].' '.$val['PatientLastName'].' '.$val['DOB'].' '.$val['AddressLine1'].' '.$val['AddressLine2'].' '.$val['City'].' '.$val['Zip']);
                    }
                }
            }
            $docRes= Doctors::where('first_name', 'LIKE','%'.$search.'%')->orwhere('last_name', 'LIKE','%'.$search.'%')
                    ->orwhere('npi', 'LIKE','%'.$search.'%')->orwhere('primary_speciality', 'LIKE','%'.$search.'%')
                    ->orwhere('phone1', 'LIKE','%'.$search.'%')->get();

            if(!$docRes->isempty()){
                foreach($docRes as $val){
                    $result[] = array("value" =>'docRes_'.$val['id'] ,"label"=>  $val['first_name'].' '.$val['last_name'].' '.$val['npi'].' '.$val['primary_speciality'].' '.$val['phone1']);
                }
            }
                
            $cenRes= Center::where('centerName', 'LIKE','%'.$search.'%')->orwhere('inputAddress', 'LIKE','%'.$search.'%')
                    ->orwhere('inputAddress2', 'LIKE','%'.$search.'%')->orwhere('inputCity', 'LIKE','%'.$search.'%')
                    ->orwhere('inputState', 'LIKE','%'.$search.'%')->orwhere('phone1', 'LIKE','%'.$search.'%')->get();
            if(!$cenRes->isempty()){
                foreach($cenRes as $val){
                    $result[] = array("value" => 'cenRes_'.$val['id'] ,"label" =>  $val['centerName'].' '.$val['inputAddress']);
                }
            }
        }
        return response()->json($result);
    }
    public function searchData(Request $request) {
        $searchVal = $request->get('search_value');
        if($searchVal == '' ||  $searchVal == 'No'){
            return redirect(route('lead.view'));
        }elseif(strpos($searchVal, 'leadRes_') !== false){
            $id = substr($searchVal, strpos($searchVal, "_") + 1);
            return redirect(url('/editLead/'.$id));
        }elseif(strpos($searchVal, 'docRes_') !== false){
            $id = substr($searchVal, strpos($searchVal, "_") + 1);
            return redirect(url('/editProvider/'.$id));
        }elseif(strpos($searchVal, 'cenRes_') !== false){
            $id = substr($searchVal, strpos($searchVal, "_") + 1);
            return redirect(url('/editCenter/'.$id));
        }elseif(strpos($searchVal, 'proRes_') !== false){
            $id = substr($searchVal, strpos($searchVal, "_") + 1);
            return redirect(url('/newLead?prospectSearchName='.$id));
        }
    }
    public function excelExport() {
        return Excel::download(new LeadExport, 'lead.xlsx');
    }
}
