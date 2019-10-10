<?php
namespace App\Traits;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use App\Log;

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
}