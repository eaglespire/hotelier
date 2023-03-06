<?php

namespace App\Http\Livewire\Booking;

use App\Constants\CacheConstants;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class AddBooking extends Component
{
    public $firstname;
    public $lastname;
    public $email;
    public $address;
    public $phone;
    public $mode;
    public $amount;
    public $arrival;
    public $nights;
    public $categories;
    public $type;
    public $rooms;
    public $room;

    protected $rules = [
        'firstname' => ['required','string','max:255'],
        'lastname' => ['required','string','max:255'],
        'email' => ['required','string','max:255'],
        'phone' => ['required','string','max:255'],
        'address' => ['required','string','max:255'],
        'nights' => ['required','numeric'],
        'arrival' => ['required'],
        'type' => ['required'],
        'room' => ['required']
    ];

    public function mount()
    {
        $categories = Cache::remember(CacheConstants::RoomCategoriesCache, now()->addDays(30), function (){
            return RoomCategory::get();
        });
        $this->fill([
            'firstname' => null,
            'lastname' => null,
            'email' => null,
            'address' => null,
            'mode' => 'offline',
            'phone' => null,
            'amount' => null,
            'arrival' => null,
            'nights' => null,
            'categories' => $categories,
            'type' => $categories[0]['id'],
        ]);
        $rooms = Cache::remember('c-rooms-cache', now()->addDays(30), function (){
            return Room::where('room_category_id',$this->type)->get();
        });
        $this->rooms = $rooms;
        $this->room = $this->rooms[0]['id'];
    }

    public function updatedType()
    {
        $this->rooms = Room::where('room_category_id',$this->type)->get();
    }

    public function SaveInformation()
    {
        $this->validate();
        //fetch the room
        $room = Room::where('id',$this->room)->first();
        $data = [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'phone' => $this->phone,
            'arrival' => $this->arrival,
            'nights' => $this->nights,
            'address' => $this->address,
            'mode' => $this->mode,
            'type' => $this->type,
            'room' => $this->room,
            'slug' => generate_random_string(64),
            'src' => $room->first_image,
            'number' => $room->room_number,
            'title' => $room->title,
            'price' => $room->price
        ];
        //save the data in session
        session()->put('booking',$data);
        return redirect(route('usr.booking.process-payment',$data['slug']));
    }

    public function render()
    {
        return view('livewire.booking.add-booking');
    }
}
