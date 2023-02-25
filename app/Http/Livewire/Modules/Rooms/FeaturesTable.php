<?php

namespace App\Http\Livewire\Modules\Rooms;

use App\Models\Feature;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class FeaturesTable extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $searchTerm = '';
    public $headers = ['S/N','Title','Icon','Actions'];

    protected $listeners = ['refreshComponent'=>'$refresh'];

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function deleteFeature($id): \Illuminate\Http\RedirectResponse
    {
        try {
            $feature = Feature::findOrFail($id);
            $feature->delete();
            $this->emitSelf('success','Feature removed successfully');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emitSelf('error','Feature not found');
        }
        return back();
    }
    public function render()
    {
        return view('livewire.modules.rooms.features-table',[
            'features' => Feature::search(['title','icon'], $this->searchTerm)
                ->latest()->select('slug','title','id','icon')
                ->simplePaginate()
        ]);
    }
}
