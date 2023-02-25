<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserActions extends Component
{
    public string $buttonText;
    public bool $displayImport;
    public bool $displayExport;
    public string $modalSize;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($buttonText = 'Add User',$displayExport = true, $displayImport = true, $modalSize ='modal-md')
    {
        $this->buttonText = $buttonText;
        $this->displayExport = $displayExport;
        $this->displayImport = $displayImport;
        $this->modalSize = $modalSize;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-actions');
    }
}
