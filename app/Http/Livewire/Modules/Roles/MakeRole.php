<?php

namespace App\Http\Livewire\Modules\Roles;

use App\Exports\RolesExport;
use App\Exports\UsersExport;
use App\Imports\RolesImport;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Bouncer;

class MakeRole extends Component
{
    use WithFileUploads;
    public $name = null;
    public $title = null;
    public $selectedFile;

    protected $rules = [
        'name' => ['required','string','unique:roles','max:255'],
        'title' => ['required','string','max:255'],
    ];

    public function updatedSelectedFile()
    {
        $this->validate([
            'selectedFile' => ['required','mimes:xlsx','max:1024']
        ]);
        Excel::import(new RolesImport, $this->selectedFile->store('files'));
        $this->emit('success','Operation successful');
        $this->emitTo('modules.roles.roles-table','refreshComponent');
    }

    public function export()
    {
        sleep(1);
        return Excel::download(new RolesExport,'roles.xlsx');
    }

    public function store()
    {
        $this->validate();
        $role = Bouncer::role()->firstOrCreate([
            'name' => $this->name,
            'title' => $this->title,
        ]);
        if ($role){
            $this->emitTo('modules.roles.roles-table','refreshComponent');
            $this->emitSelf('success', 'New Role Added Successfully');
            $this->reset(['name','title']);
        }else{
            $this->emitSelf('error','Error adding user');
        }
    }

    public function render()
    {
        return view('livewire.modules.roles.make-role');
    }
}
