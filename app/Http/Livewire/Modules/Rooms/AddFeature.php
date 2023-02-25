<?php

namespace App\Http\Livewire\Modules\Rooms;

use App\Models\Feature;
use Illuminate\Support\Str;
use Livewire\Component;

class AddFeature extends Component
{
    public $title;
    public $icon;
    public $export = false;
    public $import = false;

    protected $rules = [
        'title' => ['required','string','max:255','unique:tags'],
        'icon' => ['nullable','string']
    ];

    public function mount()
    {
        $this->fill([
            'title' => null,
            'icon' => null,
        ]);
    }

    public function IconSelected($selectedIcon)
    {
        $this->icon = $selectedIcon;
    }

    public function store()
    {
        $this->validate();
        $feature = Feature::create([
            'title' => ucwords($this->title),
            'slug' => Str::slug($this->title),
            'icon' => $this->icon
        ]);
        if ($feature){
            $this->emitTo('modules.rooms.features-table','refreshComponent');
            $this->emitSelf('success', 'New tag added ');
            $this->reset(['title','icon']);
        }else{
            $this->emitSelf('error','Error adding tag');
        }
    }
    public function render()
    {
        return view('livewire.modules.rooms.add-feature');
    }
}
