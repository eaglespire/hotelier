<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ContainerTwo extends Component
{
    public string $title;
    public string $switcherText;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = '', $switcherText = '')
    {
        $this->title = $title;
        $this->switcherText = $switcherText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.container-two');
    }
}
