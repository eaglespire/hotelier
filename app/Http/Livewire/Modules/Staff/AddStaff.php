<?php

namespace App\Http\Livewire\Modules\Staff;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Bouncer;
class AddStaff extends Component
{
    public $user_id;
    public $age;
    public $gender;
    public $role;
    public $users;
    public $roles;
    public $doe;

    protected $rules = [
        'age' => ['required','numeric'],
        'user_id' => ['required','numeric','unique:employees'],
        //'gender' => ['required'],
        'role' => ['required'],
        'doe' => ['required']
    ];
    public function mount()
    {
        $this->GetData();
        $this->fill([
            'age' => null,
            'user_id' => $this->users[0]->id,
            'gender' => 'male',
            'role' => $this->roles[0]->name,
            'doe' => null
        ]);
    }
    public function CreateStaff()
    {
        $this->validate();
        //get the staff's DOB
        $dob = Carbon::now()->subYears($this->age);
        $staff = Employee::create([
            'user_id' => $this->user_id,
            'age' => $this->age,
            'gender' => $this->gender,
            'doe' => Carbon::parse($this->doe),
            'dob'=>$dob,
            'staff_number' => Str::staff($this->age,$this->doe,$this->role),
            'role'=> $this->role
        ]);
        //update the user's status
        $staff->user->update([
            'status'=> true,
            'staff_id' => $staff->staff_number
        ]);
        //first assign a role to the user
        Bouncer::assign($this->role)->to($staff->user);
        $this->reset(['age','user_id','role','doe']);
        $this->emit('success','Staff added successfully');
        $this->emitTo('modules.staff.staff-table','refreshComponent');
    }
    protected function GetData()
    {
        $this->users = DB::table('users')->where('id', '>', 1)->get();
        $this->roles = DB::table('roles')->where('id','>',1)->get();
    }
    public function render()
    {
        //dd($this->roles);
        return view('livewire.modules.staff.add-staff');
    }
}
