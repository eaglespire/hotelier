<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VerificationController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['user-not-verified']);
    }
    public function show()
    {
        $this->data['title'] = 'Verify Your Email Address';
        $this->data['titleDesc'] = 'Verify Your Email Address';
        $this->data['description'] = 'Verify Your Email Address';
        return view('auth.verify-email',$this->data);
    }
    public function SubmitOTP(Request $request)
    {
        $request->validate([
            'digit_1' => ['required','numeric'],
            'digit_2' => ['required','numeric'],
            'digit_3' => ['required','numeric'],
            'digit_4' => ['required','numeric'],
        ]);
        //get the time the user was created
        $date1 = Carbon::createFromFormat('Y-m-d H:i:s', auth()->user()->updated_at->addMinutes(15));
        $date2 = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());

        $result = $date2->gt($date1);

        if ($result){
            toast('The otp code you supplied has expired','error');
            return back();
        }
        if (auth()->user()->otp != set_otp($request)){
            toast('The otp code you supplied does not match the one sent to you','error');
            return back();
        }
        auth()->user()->update([
            'otp' => null,
            'verified' => true
        ]);
        toast('Your account has been successfully verified','success');
        log_activity('User has successfully verified account',auth()->id());
        return redirect(route('career'));
    }
    public function ResendOTP(Request $request)
    {
        $code = build_email_otp_code();
        //send an email otp to the user
        $message = "Hi " . auth()->user()->fullname." , thanks for registering with us.";
        $message.="<br/>";
        $message.="Kindly copy the OTP code below and use it to complete your registration.";
        $message.="<br/>";
        $message.="<br/>";
        $message.="<h1>".$code."</h1>";
        $message.="<br/>";
        $message.="The code will expire in 15 minutes.";
        send_email_message(auth()->user()->email,'Please Confirm Your Email Address',$message);
        //update the db
        auth()->user()->update(['otp'=> $code]);
        toast('An otp code has been resent to your registered email','success');
        log_activity('User clicked on the password reset link again',auth()->id());
        return back();
    }
}
