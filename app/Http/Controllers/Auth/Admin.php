<?php

namespace App\Http\Controllers\Auth;

use App\AdminUser;
use Illuminate\Http\Request;
// use http\Env\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class Admin extends Controller
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

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMINPANEL;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin_user')->except('logout');
    }
    protected function login(Request $request){
        $check = AdminUser::where('email',$request->email)->first();

        if($check){
            if(Hash::check($request->password, $check->password)){
                return redirect($this->redirectTo)->with('toast',['icon'=>'success','title'=>'Welcome ']);
            }
        }

        return $request;
    }
    protected function guard()
    {
        return Auth::guard('admin_user');
    }

    public function showLoginForm()
    {
        return view('auth.adminLogin');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(\Illuminate\Http\Request $request, $user)
    {
        $user->client_ip = $request->ip();
        $user->client_user_agent = $request->server('HTTP_USER_AGENT');
        $user->update();
        return redirect($this->redirectTo)->with('toast',['icon'=>'success','title'=>'Welcome '.$user->name]);
    }
}
