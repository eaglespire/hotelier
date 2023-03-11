<?php

namespace App\Http\Livewire\Profile;

use App\Models\SocialAccount;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SocialMedia extends Component
{
    public $fb;
    public $tw;
    public $in;
    public $wh;
    public $lk;
    public $accounts;

    protected $rules = [
        'fb' => ['nullable','string'],
        'tw' => ['nullable','string'],
        'in' => ['nullable','string'],
        'wh' => ['nullable','string'],
        'lk' => ['nullable','string']
    ];

    public function mount()
    {
        $this->accounts = SocialAccount::where('user_id',auth()->id())->first();
        $this->fb = $this->accounts?->fb;
        $this->tw = $this->accounts?->tw;
        $this->in = $this->accounts?->in;
        $this->lk = $this->accounts?->lk;
        $this->wh = $this->accounts?->wh;
    }

    public function SaveAccounts()
    {
        $this->validate();
        try {
            if (empty($this->accounts)){
                SocialAccount::create([
                    'user_id' => auth()->id(),
                    'fb' => $this->fb,
                    'lk' => $this->lk,
                    'tw' => $this->tw,
                    'in' => $this->in,
                    'wh' => $this->wh
                ]);
                log_activity('Added social accounts',auth()->id());
            }else{
                $this->accounts->update([
                    'fb' => $this->fb,
                    'lk' => $this->lk,
                    'tw' => $this->tw,
                    'in' => $this->in,
                    'wh' => $this->wh
                ]);
                log_activity('Updated social accounts',auth()->id());
            }
            $this->emit('success','Accounts updated');
        } catch (\Exception $exception){
            Log::error($exception->getMessage());
            $this->emit('error','Something went wrong');
        }
    }

    public function render()
    {
        return view('livewire.profile.social-media');
    }
}
