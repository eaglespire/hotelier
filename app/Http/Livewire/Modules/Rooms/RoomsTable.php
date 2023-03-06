<?php

namespace App\Http\Livewire\Modules\Rooms;

use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class RoomsTable extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $searchTerm = '';
    public $headers = ['S/N','Image','Rm No','Title','Price','Category','Availability','Status','Actions'];

    protected $listeners = ['refreshComponent'=>'$refresh'];

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function deleteRoom(int $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $room = Room::findOrFail($id);
            $room->delete();
            $this->emitSelf('success','Room deleted');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emitSelf('error','Room not found');
        }
        return back();
    }
    public function render()
    {
        return view('livewire.modules.rooms.rooms-table',[
            'rooms' => Room::search(['title','room_number'], $this->searchTerm)
                ->with('room_category')
                ->latest()
                ->select('title','id','slug','room_number','first_image','price','is_available','is_clean','room_category_id')
                ->simplePaginate()
        ]);
    }
}
