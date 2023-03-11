<?php

namespace App\Http\Livewire\Booking;

use App\Models\BookingHistory;
use Livewire\Component;
use Livewire\WithPagination;

class RecordsTable extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $searchTerm = '';
    public $headers = ['S/N','Email','Actions'];

    protected $listeners = ['refreshComponent'=>'$refresh'];

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function deleteRecord($arr)
    {
        $email = $arr[0]['email']; //grab the email
        //find the record to delete
        BookingHistory::where('email',$email)->delete();
        $this->emit('success','Record deleted successfully');
    }

    public function render()
    {
        $records = BookingHistory::search(['firstname','lastname','email','mode'], $this->searchTerm)
            ->with(['room_category','room'])
            ->latest()
            ->select('firstname','lastname','email','phone','room_category_id','room_id','address','title',
                'gender','mode','nights','arrival','departure')
            ->simplePaginate(50);
        $records->setCollection($records->groupBy(function ($data){
            return $data->phone;
        }));
        $data['records'] = $records;
       // dd($records);
        return view('livewire.booking.records-table',$data);
    }
}
