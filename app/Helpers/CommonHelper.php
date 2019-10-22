<?php

namespace App\Helpers;
use Carbon\Carbon;
use Auth;
use DB;
use App\State;
use App\User;

class CommonHelper {
    public function getStateName($stateId) {
        $stateName = State::where('id',$stateId)->select('name')->first();
        return $stateName;
    }
    
    public function getNameById($userId) {
        $userData = User::where('id',$userId)->first();
        return $userData;
    }
}