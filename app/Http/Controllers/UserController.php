<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Role;
use App\RoleUser;
use App\Doctors;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
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
        $users = User::get();
        return view('user.index',compact('users'));
    }
    public function add_new_user(){
        $roles=Role::get();
        return view('user.add_user',compact('roles'));
    }
    public function store_user_details(Request $request){
        //$data=$request->all();
       
        if(empty($request->user_id)){
            $validatedData = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email:rfc,dns',
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
                'email' => 'required|email:rfc,dns',
                'role'=>'required'
            ]);
            $user = User::find($request->user_id);
        }
       
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->save();

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
        }else{
            $request->session()->flash('success', 'User Updated Successfully');
        }
        
        return redirect('/users');
    
    }
    public function delete_user(Request $request){
        User::where('id',$request->user_id)->delete();
    }
    public function edit_user(Request $request){
        $user_details = User::find($request->id);
        $user_role=RoleUser::where('user_id',$user_details->id)->pluck('role_id')->toArray();
        $action="edit";
        $roles=Role::get();
        return view('user.add_user',compact('user_details','action','roles','user_role'));
    }
}
