<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GalleryCard extends Component
{
    public string $src;
    public string $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $src = '', string $title = '')
    {
        $this->src = $src;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.gallery-card');
    }
}
