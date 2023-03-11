<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class CoverImage extends Component
{
    use WithFileUploads;
    public $image;
    public $src;

    protected $rules = [
        'image' => ['required','image','max:300']
    ];
    public function mount()
    {
        $data = DB::table('profile_images')->where('user_id',auth()->id())
            ->where('type','cover')
            ->first();
        if (!empty($data)){
            $this->src = $data->src;
        }else{
            $this->src = asset('dashboard/images/profile-bg.jpg');
        }
    }
    public function updatedImage()
    {
        $this->validate();
        $response = load_up_image($this->image,'cover',auth()->id());
        if ($response){
            $this->mount();
        }else{
            $this->emit('error','Something went wrong');
        }
    }

    public function render()
    {
        return view('livewire.profile.cover-image');
    }
}
