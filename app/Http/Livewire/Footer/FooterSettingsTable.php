<?php

namespace App\Http\Livewire\Footer;

use App\Models\Footer;
use Livewire\Component;

class FooterSettingsTable extends Component
{
    public $footers;

    protected $listeners = ['refreshComponent'=>'$refresh'];

    public function mount($footers)
    {
        $this->footers = $footers;
    }
    public function DeleteFooter(int $id)
    {
        $footer = Footer::find($id);
        $footer->delete();
        $this->emit('refreshComponent');
        $this->emit('success','Deleted');
        return back();
    }
    public function render()
    {
        return view('livewire.footer.footer-settings-table');
    }
}
