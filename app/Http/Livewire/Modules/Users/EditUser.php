<?php

namespace App\Http\Livewire\Modules\Users;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditUser extends Component
{
    public User $user;
    public $firstname;
    public $lastname;
    public $email;
    public $_id;

    protected function rules()
    {
        return [
           'email' => ['required', 'email', Rule::unique('users')->ignore($this->_id),'max:255'],
           'firstname' => ['required','string','max:255'],
           'lastname' => ['required','string','max:255'],
        ];
    }
    public function mount(User $user)
    {
        $this->fill([
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'email' => $user->email,
            '_id' => $user->id,
            'user' => $user
        ]);
    }
    public function UpdateUser()
    {
        $this->validate();
       $response = $this->user->update([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email
        ]);
       if ($response){
           $this->emitSelf('success','User updated successfully');
           return redirect(route('usr.users'));
       }else{
           $this->emitSelf('error','Something went wrong');
       }

    }
    public function render()
    {
        return view('livewire.modules.users.edit-user');
    }
}
