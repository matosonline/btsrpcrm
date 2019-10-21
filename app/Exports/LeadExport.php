<?php

namespace App\Exports;

use App\Lead;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class LeadExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
   
    public function view(): View
    {
        $query = Lead::leftJoin('users','leads.agent','users.id')
                 ->select('leads.id as leadId',DB::raw('CONCAT(leads.fName, leads.lName) AS Name'),
                         \DB::raw('(CASE 
                                    WHEN leads.dob = "1970-01-01" THEN ""
                                    WHEN leads.dob >= "2019-01-01" THEN ""
                                    WHEN leads.dob <  "1900-01-01" THEN ""
                                    ELSE leads.dob 
                                    END) AS dob'),'leads.phone1','leads.email','leads.agreeOrDisagree',
                        DB::raw('CONCAT(users.first_name, users.last_name) AS agentName'),'leads.lStatus','leads.created_at')
                  ->orderBy('leads.created_at','DESC')->get();
//        echo "<pre>";print_R($query);exit;
        return view('leads.exportLead', compact('query'));
    }
    
  
}
