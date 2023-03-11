<?php

namespace App\Http\Livewire\Booking;

use App\Models\BookingHistory;
use App\Models\Room;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class RecordTable extends Component
{
    use WithPagination;
    public $route = 'usr.booking.booking-records';
    public $phone;

    public $paginationTheme = 'bootstrap';
    public $searchTerm = '';
    public $headers = ['S/N','Title','Name','Gender','Rm No','Phone','Actions'];

    protected $listeners = ['refreshComponent'=>'$refresh'];

    public function mount($phone)
    {
        $this->phone = $phone;
    }

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function deleteRecord(int $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $room = BookingHistory::findOrFail($id);
            $room->delete();
            $this->emitSelf('success','Record deleted');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emitSelf('error','Something went wrong');
        }
        return back();
    }
    public function render()
    {
        $records = BookingHistory::search(['firstname','lastname','mode','title'], $this->searchTerm)
            ->latest()->with(['room','room_category'])
            ->where('phone',$this->phone)
            ->select('firstname','lastname','email','id','address','phone','room_id','room_category_id',
            'arrival','departure','title','gender','nights','mode')
            ->simplePaginate();
        $data['records'] = $records;
        $data['phone'] = $this->phone;
        return view('livewire.booking.record-table',$data);
    }
}
