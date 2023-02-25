<?php

namespace App\Http\Livewire\Modules\Rooms;

use App\Models\Feature;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;

class EditFeature extends Component
{
    public Feature $feature;
    public $icon;
    public $title;
    public function mount($feature)
    {
        $this->feature = $feature;
        $this->icon = $feature->icon;
        $this->title = $feature->title;
    }
    public function IconSelected($selectedIcon)
    {
        $this->icon = $selectedIcon;
    }
    public function UpdateFeature()
    {
        try {
            $feature = Feature::findOrFail($this->feature->id);
            $feature->update([
               'icon' => $this->icon,
               'title' => ucwords($this->title),
               'slug' => Str::slug($this->title)
            ]);
            $this->emit('success','Updated successfully');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emit('error','Record not found');
        }
        return redirect(route('usr.room.features'));
    }
    public function render()
    {
        return view('livewire.modules.rooms.edit-feature');
    }
}
