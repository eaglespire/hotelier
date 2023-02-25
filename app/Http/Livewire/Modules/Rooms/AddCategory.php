<?php

namespace App\Http\Livewire\Modules\Rooms;

use App\Exports\RoomCategoryExport;
use App\Imports\RoomCategoryImport;
use App\Models\RoomCategory;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class AddCategory extends Component
{
    use WithFileUploads;
    public $name;
    public $description;
    public $selectedFile;

    protected $rules = [
        'name' => ['required','string','max:255','unique:room_categories'],
        'description' => ['nullable','string'],
    ];

    public function mount()
    {
        $this->fill([
            'name' => null,
            'description' => null,
        ]);
    }

    public function updatedSelectedFile()
    {
        $this->validate([
            'selectedFile' => ['required','mimes:xlsx','max:1024']
        ]);
        Excel::import(new RoomCategoryImport, $this->selectedFile->store('files'));
        $this->emit('success','Operation successful');
        $this->emitTo('modules.rooms.room-categories-table','refreshComponent');
    }

    public function export()
    {
        sleep(1);
        return Excel::download(new RoomCategoryExport,'room-categories.xlsx');
    }

    public function store()
    {
        $this->validate();
        $user = RoomCategory::create([
            'name' => $this->name,
            'description' => $this->description,
            'slug' => Str::slug($this->name)
        ]);
        if ($user){
            $this->emitTo('modules.rooms.room-categories-table','refreshComponent');
            $this->emitSelf('success', 'New category added ');
            $this->reset(['name','description']);
        }else{
            $this->emitSelf('error','Error adding category');
        }
    }

    public function render()
    {
        return view('livewire.modules.rooms.add-category');
    }
}
