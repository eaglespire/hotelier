<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Folder extends Component
{
    public string $name;
    public string $folder;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = 'Folder', $folder = '')
    {
        $this->name = $name;
        $this->folder = $folder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.folder');
    }
}
