<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = "/dashboard";
    public function redirectTo()
    {
        if(Auth::check())
        {
            if(Auth::user()->role_id == 1) { //admin
                return "/";
            }else if(Auth::user()->role_id == 2) //employee
            {
                return "/";
            }else if(Auth::user()->role_id == 3) // codeowner
            {
                return "/";
            }else
            {
                return redirect()->route('login');
            }
        }else
        {
            return redirect()->route('login');
        }  
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
    public function mylogin(Request $request)
    {
        //return $request->all();
        $validate = Validator::make(
            $request->only('username', 'password'),
            [
                'username' => 'required',
                'password' => 'required'
            ]
        );
        if ($validate->fails()) {
            return redirect()->route('login')->withErrors($validate)->withInput();
        }
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            if(Auth::check())
            {
                return redirect("/");
            }else
            {
                return redirect()->route('login')->with("status", "Incorrect username and password");
            }
        }
        return redirect()->route('login')->with("status", "Incorrect username and password");

    }
    public function loginForm()
    {
        return view("auth.login");
    }
}
?>