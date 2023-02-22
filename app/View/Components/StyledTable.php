<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StyledTable extends Component
{
    public array $headers;
    public $collection;
    public $searchPlaceHolder;
    public $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($headers = [], $collection = null, $searchPlaceHolder = 'Search...', $title = 'Users')
    {
        $this->headers = $headers;
        $this->collection = $collection;
        $this->searchPlaceHolder = $searchPlaceHolder;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.styled-table');
    }
}
