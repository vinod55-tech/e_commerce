<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Auth;
use Hash;
use Mail;
use Session;
use App\Mail\OTPverificarionMail;
use Illuminate\Support\Carbon;

class ChangepasswordController extends Controller
{
    public function index(){
        return view('changepassword');
    }

    public function get_otp(){
        return view('get_otp');
    }
    public function update_password(Request $request)
    {
        
            # Validation
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:8'
            ]);
            

            #Match The Old Password
            if(!Hash::check($request->old_password, auth()->user()->password)){
                return back()->with("error", "Old Password Doesn't match!");
            }
            Session::put('new_password',$request->new_password);
            
            #Create, update and send OTP
            $otp = rand(000000, 999999);
            User::where('id',Auth::user()->id)->update([
                'otp' => $otp
            ]);
            Mail::to(AUth::user()->email)->send(new OTPverificarionMail($otp));
            return redirect()->route('get_otp')->with("success", "OTP has been send to your email.");

    }

    public function verify_otp(Request $request){
         #OTP Validation
        $request->validate([
            'otp'=> 'required|digits:6'
        ]);

        $user = Auth::user();

        #OTP time calculation
        $otp_time = $user->updated_at->format('Y-m-d H:i:s');
        $now = date('Y-m-d H:i:s');

        $c_otp_time = new Carbon($otp_time);
        $current = new Carbon($now);
        $check = $c_otp_time->diff($current)->format('%H:%I:%S');

         #update password
        if($request->otp == $user->otp && $check < "00:02:00"){
            
            User::where('id',Auth::user()->id)->update([
                'password' => Hash::make(Session::get('new_password')),
                'otp' => null
            ]);
    
            return redirect('/')->with("success", "Password changed successfully!");
        }else{
            return back()->with("error", "Invalid OTP. Please try again.");
        }
    }


}
