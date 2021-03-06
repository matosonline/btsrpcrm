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
use Illuminate\Support\Facades\Redirect;
use Alert;

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
        if (Auth::user()->hasRole('Admin')) {
            $state = State::get();
            return view('centers.newCenter', compact('state'));
        }else{
            Alert::error('You do not have permission to perform this action!')->persistent('Close');
            return Redirect::to('dashboard');
        }
        
    }
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
            $center = Center::orderBy('id','DESC')->get()->toArray();
            return view('centers.index', compact('center'));
        }else{
            Alert::error('You do not have permission to perform this action!')->persistent('Close');
            return Redirect::to('dashboard');
        }
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
        $data['phone1'] =  ($data['phone1'])?str_replace(' ', '', str_replace(str_split('\\/:*?"<>()-|'),'',$data['phone1'])):NULL;
        $data['fax1'] =  ($data['fax1'])?str_replace(' ', '', str_replace(str_split('\\/:*?"<>()-|'),'',$data['fax1'])):NULL;
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
        if (Auth::user()->hasRole('Admin')) {
            $center_details = Center::find($request->center_id);
            $state = State::get();
            return view('centers.editCenter', compact('center_details','state'));
        }else{
            Alert::error('You do not have permission to perform this action!')->persistent('Close');
            return Redirect::to('dashboard');
        }
    }
    
}
