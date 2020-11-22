<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LaboratoriesLoginController extends Controller
{
    public function __construct(){
        $this -> middleware('guest:laboratory', ['except'=>['logout']]);
    }
    public function showLoginForm(){
        
        return view('auth.laboratory-login');
    }

    public function login(Request $request){
            //validate
        $this ->validate($request,[
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);
            //attempt to login the  user in
        if(Auth::guard('laboratory')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember)) {
            //successfully then redirect to the intented location
            return redirect()->intended(route('laboratory.dashboard'));
        }
            //if unsuccessully rediret back
            return redirect()->back()->withInput($request->only('email','remember'));
    }
    public function logout()
    {
        Auth::guard('laboratory')->logout();

        return redirect('/');
    }
}
