<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Session;
use App\Notifications\RegistrationMail;

class RegisterController extends Controller
{
    public function index(){
        return view('register');
    }

    public function create_user(Request $request){
        $validation = $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8',
            'confirm_password'=>'required|same:password'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->notify(new RegistrationMail($user));
        return redirect()->route('login')->with('success','You are registered successfully., Please login');
    }

    public function login(){
        return view('login');
    }

    public function login_form(Request $request){

        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8'
        ]);

        if(Auth::attempt($credentials)){
            return redirect('/dashboard')->with('success','You are loggedin successfully.');
        }else{
            return redirect()->back()->with('error','Your credentials are not match.');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->back()->with('success','You are loggedout.');
    }
}
