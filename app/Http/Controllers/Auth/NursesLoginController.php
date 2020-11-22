<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class NursesLoginController extends Controller
{
    public function __construct(){
        $this -> middleware('guest:nurse', ['except'=>['logout']]);
    }
    public function showLoginForm(){
        
        return view('auth.nurse-login');
    }

    public function login(Request $request){
            //validate
        $this ->validate($request,[
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);
            //attempt to login the  user in
        if(Auth::guard('nurse')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember)) {
            //successfully then redirect to the intented location
            return redirect()->intended(route('nurse.dashboard'));
        }
            //if unsuccessully rediret back
            return redirect()->back()->withInput($request->only('email','remember'));
    }
    public function logout()
    {
        Auth::guard('nurse')->logout();

        return redirect('/');
    }
}

