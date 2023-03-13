<?php

namespace App\Http\Livewire\Modules\Users;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;


class CreateUser extends Component
{
    use WithFileUploads;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $selectedFile;

    protected $rules = [
        'firstname' => ['required','string','max:255'],
        'lastname' => ['required','string','max:255'],
        'email' => ['required','email','unique:users','max:255']
    ];

    public function mount()
    {
        $this->fill([
            'firstname' => null,
            'lastname' => null,
            'email' => null,
            'password' => null
        ]);
    }

    public function updatedSelectedFile()
    {
        $this->validate([
            'selectedFile' => ['required','mimes:xlsx','max:1024']
        ]);
        Excel::import(new UsersImport, $this->selectedFile->store('files'));
        $this->emit('success','Operation successful');
        $this->emitTo('modules.users.users-table','refreshComponent');
    }

    public function export()
    {
        sleep(1);
        return Excel::download(new UsersExport,'users.xlsx');
    }

    public function store()
    {
        $this->validate();
        $user = User::create([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'password' => Hash::make('password'),
            'slug' => Str::slugger($this->email),
            'verified' => true
        ]);
        //send a mail to that user with his/her account details and a welcome mail
        $subject = "Your New ". config('app.name') . " user account is ready";
        $message = "<h1>"."Your new " . config('app.name') . " user account is set" . "</h1>";
        $message.="<br/>";
        $message.="Hello ". $user->fullname . ", welcome to ". config('app.name');
        $message.= "<br/>";
        $message.="<p>Your login details are given below</p>";
        $message.= "<br/>";
        $message.="Email : ". $user->email;
        $message.= "<br/>";
        $message.="Password : password";
        $message.= "<br/>";
        $message.="<a href='/career' style='background-color: #405189; color: #ffffff; padding: 1rem; border-radius: 10px; border: none;display: block; margin-top: 1rem;'>Access Your Dashboard</a>";

        //dd($user->email,$subject,$message);
        $response = send_email_message($user->email,$subject,$message);
        if ($user){
            $this->emitTo('modules.users.users-table','refreshComponent');
            $this->emitSelf('success', 'New User Added Successfully');
            $this->reset(['firstname','lastname','email']);
        }else{
            $this->emitSelf('error','Error adding user');
        }
    }

    public function render()
    {
        return view('livewire.modules.users.create-user');
    }
}
