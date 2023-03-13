<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::VISITOR;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'slug' => Str::slugger($data['email']),
            'otp'=> build_email_otp_code(),
            'verified' => 0
        ]);
        //send an email otp to the user
        $message = "Hi ". $data['firstname']." ". $data['lastname']. " , thanks for registering with us.";
        $message.="<br/>";
        $message.="Kindly copy the OTP code below and use it to complete your registration.";
        $message.="<br/>";
        $message.="<br/>";
        $message.="<h1>".$user['otp']."</h1>";
        $message.="<br/>";
        $message.="The code will expire in 60 minutes.";
        send_email_message($data['email'],'Please Confirm Your Email Address',$message);
        log_activity('A new user has registered into the platform',$user->id);
        return $user;
    }
    public function showRegistrationForm()
    {
        $this->data['title'] = 'Register';
        $this->data['titleDesc'] = 'Register';
        $this->data['description'] = 'Register';
        return view('auth.register',$this->data);
    }
    protected function registered(Request $request, $user)
    {
        return redirect()->route('auth.verify');
    }


}
