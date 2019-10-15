<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Traits\LogData;
use App\User;
use App\LoginLog;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function login(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if( $user && $user->status == 1){
            throw ValidationException::withMessages([
                $this->username() => [trans('auth.manyAttempts')],
            ]);
        }
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->insertLog($request->user_id,'Fail Login',$request->email,'');
            $this->insertLoginLog($request->email,\Request::ip());
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $this->insertLog($request->user_id,'Success Login','','');
            LoginLog::where('username',$request->email)->update(['login_count'=>0]);
            User::where('email',$request->email)->update(['last_login'=>date('Y-m-d H:i:s')]);
            
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        
        $this->incrementLoginAttempts($request);
        $this->insertLog($request->user_id,'Fail Login',$request->email,'');
        $this->insertLoginLog($request->email,\Request::ip());
        return $this->sendFailedLoginResponse($request);
    }
}
