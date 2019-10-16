<?php

namespace App\Http\Controllers;

use App\Doctors;
use App\DoctorsAgent;
use App\Center;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpseclib\System\SSH\Agent;
use Illuminate\Support\Facades\Mail;
use App\State;
use App\Traits\LogData;
use App\Log;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use LogData;
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
    {
        $state = State::get();
        return view('centers.newCenter', compact('state'));
    }
    public function index()
    {
        $center = Center::orderBy('id','DESC')->get()->toArray();
        return view('centers.index', compact('center'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validatedData = $request->validate([
                'centerName' => 'required',
                'inputAddress' => 'required',
                'inputAddress2' => 'required',
                'inputCity' => 'required',
                'inputState' => 'required',
                'inputZip' => 'required',
                'phone1' => 'required',
                'fax1'=>'required'
        ]);
        if(array_key_exists('id',$data)){
            unset($data['_token']);
            
            $getOldData = Center::where('id',$data['id'])->first();
            
            $old_data = json_encode($getOldData);
            $new_data = json_encode($data);
            
            $this->insertLog($data['id'],'Edit Center',$old_data,$new_data);
            Center::where('id',$data['id'])->update($data);
        }else{
            $newCenter = Center::create($data);
            $new_data = json_encode($data);
            $this->insertLog($newCenter->id,'Add Center','',$new_data);
        }
        return redirect()->back()->with('message', 'Record Updated!');
    }

    
    public function edit(Request $request)
    {
        $center_details = Center::find($request->center_id);
        $state = State::get();
        return view('centers.editCenter', compact('center_details','state'));
    }
    
}
