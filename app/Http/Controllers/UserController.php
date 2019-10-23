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
use App\LoginLog;
use App\DoctorsAgent;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Alert;
class UserController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
            $users = User::get();
            return view('user.index',compact('users'));
        }else{
            Alert::error('You do not have permission to perform this action!')->persistent('Close');
            return Redirect::to('dashboard');
        }
    }
    public function add_new_user(){
        if (Auth::user()->hasRole('Admin')) {
            $roles=Role::get();
            $doctorList  = Doctors::get();
            return view('user.add_user',compact('roles','doctorList'));
        }else{
            Alert::error('You do not have permission to perform this action!')->persistent('Close');
            return Redirect::to('dashboard');
        }
    }
    public function store_user_details(Request $request){
        //$data=$request->all();
        if(empty($request->user_id)){
            $validatedData = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'confirm_password' => 'required',
                'role'=>'required'
            ]);
            $user = new User();
            $user->password = bcrypt($request->password);
        }else{
            $validatedData = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'role'=>'required',
                'status'=>'required'
            ]);
            $oldData = $user = User::find($request->user_id);
            $user->password = bcrypt($request->password);
            
        }
       
        $user->phone_number =  ($user->phone_number)?str_replace(' ', '', str_replace(str_split('\\/:*?"<>()-|'),'',$user->phone_number)):NULL;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->status = ($request->status)?$request->status:0;
        $user->save();
        if(!empty($request->doctore_list) && $request->role == 2){
            $doctor_list = $request->doctore_list;
            DoctorsAgent::where('agent_id',$user->id)->delete();
            foreach($doctor_list as $docId){
                $doctorsAgent = new DoctorsAgent();
                $doctorsAgent->doctor_id = $docId;
                $doctorsAgent->agent_id = $user->id;
                $doctorsAgent->save();
            }
        }else{
            DoctorsAgent::where('agent_id',$user->id)->delete();
        }
        //reset login attempt
        if($request->status == 0){
            LoginLog::where('username',$request->email)->update(['login_count'=>0]);
        }

        $check_role = RoleUser::where('user_id',$user->id)->first();
        if(empty($check_role)){
            $user_role = new RoleUser();
            $user_role->user_id=$user->id;
            $user_role->role_id=$request->role;
            $user_role->create_by = Auth::user()->id;
            $user_role->save();
        }else{
            $check_role->role_id = $request->role;
            $check_role->update_by = Auth::user()->id;
            $check_role->save();
        }
        
        if(empty($request->user_id)){
            $request->session()->flash('success', 'New User Added');
            
            $new_data = json_encode($request);
            $this->insertLog($user->id,'Add User','',$new_data);
        }else{
            $request->session()->flash('success', 'User Updated Successfully');
            
            $new_data = json_encode($user);
            $old_data = json_encode($oldData);
            $this->insertLog($request->user_id,'Edit User',$old_data,$new_data);
        }
        
        return redirect('/users');
    
    }
    public function delete_user(Request $request){

        $data = User::find($request->user_id);
        $new_data = json_encode($data);
        $this->insertLog($request->user_id,'Delete User','',$new_data);
        User::where('id',$request->user_id)->delete();
    }
    public function edit_user(Request $request){
        if (Auth::user()->hasRole('Admin')) {
            $agentDoctorArray = array();
            $user_details = User::find($request->id);
            $doctorList  = Doctors::get();
            $agent_doctor = DoctorsAgent::where('agent_id',$request->id)->select('doctor_id')->get();
            if(!$agent_doctor->isempty()){
                foreach($agent_doctor as $doc){
                    $agentDoctorArray[] = $doc->doctor_id;
                }
            }
            $user_role=RoleUser::where('user_id',$user_details->id)->pluck('role_id')->toArray();
            $action="edit";
            $roles=Role::get();
            return view('user.add_user',compact('user_details','action','roles','user_role','doctorList','agentDoctorArray'));
        }else{
            Alert::error('You do not have permission to perform this action!')->persistent('Close');
            return Redirect::to('dashboard');
        }
    }
    public function profile(Request $request) {
        $user_details = User::find(Auth::user()->id);
        return view('user.profile_user',compact('user_details'));
    }
    public function changePassword(Request $request) {
        return view('user.change_password');
    }
    
    public function editPassword(Request $request) {
        $validatedData = $request->validate([
            'password' => 'required',
            'confirm_password' => 'required'
        ]);
        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($request->password);
        $user->save();
        $this->insertLoginLog($user->email,\Request::ip());
        return redirect('viewprofile')->with('message', 'Passowed Updated!');;
    }
    
}
