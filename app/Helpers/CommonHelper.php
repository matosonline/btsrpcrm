<?php

namespace App\Helpers;
use Carbon\Carbon;
use Auth;
use DB;
use App\State;

class CommonHelper {
    public function getStateName($stateId) {
        $stateName = State::where('id',$stateId)->select('name')->first();
        return $stateName;
    }
}