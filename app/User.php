<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        'name', 'email', 'password',
    ];*/

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function roles()
    {
      
        $user_role = RoleUser::where('user_id',Auth::user()->id)->pluck('role_id');
        return Role::whereIn('id',$user_role)->get();
    }
    
    public function hasRole($role)
    {
       
        foreach ($this->roles() as $role_data)
        {
            
            if ($role_data->name == $role)
            {
                
                return true;
            }
        }

        return false;
    }
    
    public function hasPermssion($role,$permission)
    {
        $user_role = RoleUser::where('user_id',Auth::user()->id)->pluck('role_id');
        return Role::whereIn('id',$user_role)->get();

        return false;
    }
}
