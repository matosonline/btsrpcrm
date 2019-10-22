<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Role;
use App\RoleUser;
use App\Doctors;
use Illuminate\Support\Facades\Auth;
use App\Traits\LogData;
use App\Log;
use Illuminate\Support\Facades\Redirect;
use Alert;
class LogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    use LogData;
    public function __construct()
    {
       
        $this->middleware('auth');
    }
    
    
    public function viewLeadLog(Request $request){
        if(Auth::user()->hasRole('msmc-manager') || Auth::user()->hasRole('Admin')){
            $leadLog = Log::where('activity_name','Edit Lead')->where('activity_id',$request->lead_id)->get();

            $logArray = $oldDataArray = $newDataArray = array();
            if(!$leadLog->isempty()){
                foreach($leadLog as $key => $val){
                    $logArray[$key]['id'] = $val->id;
                    $logArray[$key]['username'] = $val->username;
                    $logArray[$key]['created_at'] = $val->created_at;
                }
            }
            echo view('logs.viewLeadLog',compact('logArray'))->render();
        }else{
            Alert::error('You do not have permission to perform this action!')->persistent('Close');
            return Redirect::to('dashboard');
        }
    }
    
     public function viewUserLog(Request $request){
        if(Auth::user()->hasRole('msmc-manager') || Auth::user()->hasRole('Admin')){
            $leadLog = Log::where('activity_name','Edit User')->where('activity_id',$request->user_id)->get();

            $logArray = $oldDataArray = $newDataArray = array();
            if(!$leadLog->isempty()){
                foreach($leadLog as $key => $val){
                    $logArray[$key]['id'] = $val->id;
                    $logArray[$key]['username'] = $val->username;
                    $logArray[$key]['created_at'] = $val->created_at;
                }
            }
            echo view('logs.viewUserLog',compact('logArray'))->render();
        }else{
            Alert::error('You do not have permission to perform this action!')->persistent('Close');
            return Redirect::to('dashboard');
        }
    }
    
    
    public function viewProviderLog(Request $request){
        if(Auth::user()->hasRole('msmc-manager') || Auth::user()->hasRole('Admin')){
            $leadLog = Log::where('activity_name','Edit Provider')->where('activity_id',$request->provider_id)->get();

            $logArray = $oldDataArray = $newDataArray = array();
            if(!$leadLog->isempty()){
                foreach($leadLog as $key => $val){
                    $logArray[$key]['id'] = $val->id;
                    $logArray[$key]['username'] = $val->username;
                    $logArray[$key]['created_at'] = $val->created_at;
                }
            }
            echo view('logs.viewProviderLog',compact('logArray'))->render();
        }else{
                Alert::error('You do not have permission to perform this action!')->persistent('Close');
                return Redirect::to('dashboard');
            }
    }
    public function viewCenterLog(Request $request){
        if(Auth::user()->hasRole('msmc-manager') || Auth::user()->hasRole('Admin')){
            $leadLog = Log::where('activity_name','Edit Center')->where('activity_id',$request->center_id)->get();

            $logArray = $oldDataArray = $newDataArray = array();
            if(!$leadLog->isempty()){
                foreach($leadLog as $key => $val){
                    $logArray[$key]['id'] = $val->id;
                    $logArray[$key]['username'] = $val->username;
                    $logArray[$key]['created_at'] = $val->created_at;
                }
            }
            echo view('logs.viewCenterLog',compact('logArray'))->render();
        }else{
            Alert::error('You do not have permission to perform this action!')->persistent('Close');
            return Redirect::to('dashboard');
        }
    }
    
    public function viewAllLogs(Request $request) {
        if(Auth::user()->hasRole('msmc-manager') || Auth::user()->hasRole('Admin')){
            $leadLog = Log::get();
            $logArray = $oldDataArray = $newDataArray = array();
            if(!$leadLog->isempty()){
                foreach($leadLog as $key => $val){

                    $logArray[$key]['id'] = $val->id;
                    $logArray[$key]['activity_name'] = $val->activity_name;
                    $logArray[$key]['username'] = $val->username;
                    $logArray[$key]['created_at'] = $val->created_at;
                }
            }
            echo view('logs.viewAllLog',compact('logArray'))->render();
        }else{
            Alert::error('You do not have permission to perform this action!')->persistent('Close');
            return Redirect::to('dashboard');
        }
    }
    public function viewLogDetail(Request $request) {
         $log_view_type =  $request->log_view_type;
         $logData = Log::where('id',$request->log_id)->select('old_data','new_data')->get();
         $doctors = Doctors::get();
         echo view('logs.modal.viewLogModal',compact('logData','doctors','log_view_type'))->render();
    }
}
