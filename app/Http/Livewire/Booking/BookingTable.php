<?php

namespace App\Http\Livewire\Booking;

use App\Models\Booking;
use Livewire\Component;
use Livewire\WithPagination;

class BookingTable extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $searchTerm = '';
    public $headers = ['S/N','Name','Rm No','Arrival','Departure','Actions'];

    protected $listeners = ['refreshComponent'=>'$refresh'];

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function CheckOutGuest($bookingId, $departure)
    {
        if (check_out_guest($bookingId,$departure)){
            $this->emit('success','Guest checked out successfully');
        }else{
            $this->emit('error','Something went wrong');
        }
    }

    public function render()
    {
        return view('livewire.booking.booking-table', [
            'bookings' => Booking::search($this->searchTerm)
                        ->with(['guest','room','room_category'])
                        ->latest()
                        ->simplePaginate(50)
        ]);
    }
}
