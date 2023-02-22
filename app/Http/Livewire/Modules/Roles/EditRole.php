<?php

namespace App\Http\Livewire\Modules\Roles;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditRole extends Component
{
    public $name;
    public $title;
    public $_id;

    protected function rules()
    {
        return [
            'name' => ['required',Rule::unique('roles')->ignore($this->_id),'string','max:255'],
            'title' => ['required', 'string','max:255']
        ];
    }
    public function mount($role)
    {
        $this->_id = $role->id;
        $this->title = $role->title;
        $this->name = $role->name;
    }
    public function UpdateRole()
    {
        $this->validate();
        $response = DB::table('roles')
            ->where('id',$this->_id)
            ->update([
                'name' => $this->name,
                'title' => $this->title
            ]);
        if($response){
            $this->emitSelf('success','Role updated...');
            return redirect(route('usr.permissions'));
        }else{
            $this->emitSelf('error','An error occurred');
        }
    }

    public function render()
    {
        return view('livewire.modules.roles.edit-role');
    }
}
