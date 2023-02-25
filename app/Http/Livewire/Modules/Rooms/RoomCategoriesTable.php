<?php

namespace App\Http\Livewire\Modules\Rooms;

use App\Models\RoomCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class RoomCategoriesTable extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $searchTerm = '';
    public $headers = ['S/N','Name','Description','Actions'];

    protected $listeners = ['refreshComponent'=>'$refresh'];

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function deleteCategory(int $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $user = RoomCategory::findOrFail($id);
            $user->delete();
            $this->emitSelf('success','Category removed successfully');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emitSelf('error','Room category not found');
        }
        return back();
    }

    public function render()
    {
        return view('livewire.modules.rooms.room-categories-table',[
            'categories' => RoomCategory::search(['name'], $this->searchTerm)
                            ->latest()
                            ->select('name','id','slug','description')
                            ->simplePaginate()
        ]);
    }
}
