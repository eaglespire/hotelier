<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActionButton extends Component
{
    public $toolTip;
    public $color;
    public $title;
    public $icon;
    public $file;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($color = 'btn-primary', $title = 'Edit', $toolTip = 'Edit', $icon = 'ri-equalizer-fill', $file = false)
    {
        $this->color = $color;
        $this->toolTip = $toolTip;
        $this->title = $title;
        $this->icon = $icon;
        $this->file = $file;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.action-button');
    }
}
