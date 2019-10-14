<?php
namespace App\Traits;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use App\Log;
use App\LoginLog;
use App\User;

trait LogData
{
    public function insertLog($activityId,$activityName,$old_data = '',$new_data= '')
    {
        $obj                 = new Log;
        $obj->activity_id    = $activityId;
        $obj->activity_name  = $activityName;
        $obj->old_data       = ($activityName != 'Fail Login')?$old_data:'';
        $obj->new_data       = $new_data;
        $obj->username       = ($activityName != 'Fail Login')?Auth::user()->email:$old_data;
        $obj->save();

        return true;
    }
    
    public function insertLoginLog($userName,$ip){
        $login_count = 1;
        $checkExist = LoginLog::where('username',$userName)->where('ip_address',$ip)->first();
        if($checkExist && $checkExist->login_count < 3){
            $login_count = $login_count + $checkExist->login_count;
            LoginLog::where('username',$userName)->where('ip_address',$ip)->update(['login_count'=>$login_count]);
            if($login_count == 3){
                User::where('email',$userName)->update(['status'=>1]);
            }
        }else{
            $obj                 = new LoginLog;
            $obj->username       = $userName;
            $obj->ip_address     = $ip;
            $obj->login_count    = $login_count;
            $obj->save();
        }
        return true; 
     }
}