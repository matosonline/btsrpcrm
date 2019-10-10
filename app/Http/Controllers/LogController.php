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
        $leadLog = Log::where('activity_name','Edit Lead')->where('activity_id',$request->lead_id)->get();
        
        $logArray = $oldDataArray = $newDataArray = array();
        if(!$leadLog->isempty()){
            foreach($leadLog as $key => $val){
                $oldData = json_decode($val->old_data,true);
                $newData = json_decode($val->new_data,true);
                unset($oldData['id'],$oldData['updated_at'],$oldData['created_at'],$oldData['deleted_at']);
                unset($newData['id']);
                $logArray[$key]['username'] = $val->username;
                $logArray[$key]['created_at'] = $val->created_at;
                $logArray[$key]['old_data'] = (!empty($oldData))?urldecode(http_build_query($oldData,'',', ')):'';
                $logArray[$key]['new_data'] = (!empty($newData))?urldecode(http_build_query($newData,'',', ')):'';
            }
        }
        echo view('logs.viewLeadLog',compact('logArray'))->render();
    }
    
     public function viewUserLog(Request $request){
        $leadLog = Log::where('activity_name','Edit User')->where('activity_id',$request->user_id)->get();
        
        $logArray = $oldDataArray = $newDataArray = array();
        if(!$leadLog->isempty()){
            foreach($leadLog as $key => $val){
                $oldData = json_decode($val->old_data,true);
                $newData = json_decode($val->new_data,true);
                unset($oldData['id'],$oldData['updated_at'],$oldData['created_at'],$oldData['deleted_at']);
                unset($newData['id'],$newData['updated_at']);
                $logArray[$key]['username'] = $val->username;
                $logArray[$key]['created_at'] = $val->created_at;
                $logArray[$key]['old_data'] = (!empty($oldData))?urldecode(http_build_query($oldData,'',', ')):'';
                $logArray[$key]['new_data'] = (!empty($newData))?urldecode(http_build_query($newData,'',', ')):'';
            }
        }
        echo view('logs.viewUserLog',compact('logArray'))->render();
    }
    
    
    public function viewProviderLog(Request $request){
        $leadLog = Log::where('activity_name','Edit Provider')->where('activity_id',$request->provider_id)->get();
        
        $logArray = $oldDataArray = $newDataArray = array();
        if(!$leadLog->isempty()){
            foreach($leadLog as $key => $val){
                $oldData = json_decode($val->old_data,true);
                $newData = json_decode($val->new_data,true);
                unset($oldData['id'],$oldData['updated_at'],$oldData['created_at'],$oldData['deleted_at'],$oldData['create_by'],$oldData['update_by']);
                unset($newData['id'],$newData['_token']);
                $logArray[$key]['username'] = $val->username;
                $logArray[$key]['created_at'] = $val->created_at;
                $logArray[$key]['old_data'] = (!empty($oldData))?urldecode(http_build_query($oldData,'',', ')):'';
                $logArray[$key]['new_data'] = (!empty($newData))?urldecode(http_build_query($newData,'',', ')):'';
            }
        }
        echo view('logs.viewProviderLog',compact('logArray'))->render();
    }
    public function viewCenterLog(Request $request){
        $leadLog = Log::where('activity_name','Edit Center')->where('activity_id',$request->center_id)->get();
        
        $logArray = $oldDataArray = $newDataArray = array();
        if(!$leadLog->isempty()){
            foreach($leadLog as $key => $val){
                $oldData = json_decode($val->old_data,true);
                $newData = json_decode($val->new_data,true);
                unset($oldData['id'],$oldData['updated_at'],$oldData['created_at'],$oldData['deleted_at']);
                unset($newData['id']);
                $logArray[$key]['username'] = $val->username;
                $logArray[$key]['created_at'] = $val->created_at;
                $logArray[$key]['old_data'] = (!empty($oldData))?urldecode(http_build_query($oldData,'',', ')):'';
                $logArray[$key]['new_data'] = (!empty($newData))?urldecode(http_build_query($newData,'',', ')):'';
            }
        }
        echo view('logs.viewCenterLog',compact('logArray'))->render();
    }
    
    public function viewAllLogs(Request $request) {
        $leadLog = Log::get();
        $logArray = $oldDataArray = $newDataArray = array();
        if(!$leadLog->isempty()){
            foreach($leadLog as $key => $val){
                $oldData = json_decode($val->old_data,true);
                $newData = json_decode($val->new_data,true);
                
                unset($oldData['id'],$oldData['updated_at'],$oldData['created_at'],$oldData['deleted_at']);
                unset($newData['id'],$newData['_token'],$newData['updated_at']);
                
                $logArray[$key]['activity_name'] = $val->activity_name;
                $logArray[$key]['username'] = $val->username;
                $logArray[$key]['created_at'] = $val->created_at;
                $logArray[$key]['old_data'] = (!empty($oldData))?urldecode(http_build_query($oldData,'',', ')):'';
                $logArray[$key]['new_data'] = (!empty($newData))?urldecode(http_build_query($newData,'',', ')):'';
            }
        }
        echo view('logs.viewAllLog',compact('logArray'))->render();
    }
}
