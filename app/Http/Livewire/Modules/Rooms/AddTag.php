<?php

namespace App\Http\Livewire\Modules\Rooms;
use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\Component;

class AddTag extends Component
{

    public $title;
    public $export = false;
    public $import = false;

    protected $rules = [
        'title' => ['required','string','max:255','unique:tags'],
    ];

    public function mount()
    {
        $this->fill(['title' => null]);
    }

    public function store()
    {
        $this->validate();
        $tag = Tag::create([
            'title' => ucwords($this->title),
            'slug' => Str::slug($this->title)
        ]);
        if ($tag){
            $this->emitTo('modules.rooms.tags-table','refreshComponent');
            $this->emitSelf('success', 'New tag added ');
            $this->reset(['title']);
        }else{
            $this->emitSelf('error','Error adding tag');
        }
    }

    public function render()
    {
        return view('livewire.modules.rooms.add-tag');
    }
}
