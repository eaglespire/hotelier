<?php

namespace App\View\Components;

use App\Models\FooterTitle;
use Illuminate\View\Component;

class FooterSetting extends Component
{
    public string $column;
    public $header;
    public string $col;
    public string $titleType;
    public string $titleText;
    public string $titleImage;
    public string $selectIcon;
    public string $chooseIcon;
    public string $makeLink;
    public string $pinkLink;
    public $footers;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($footers,$header,$col,$column,$titleType,$titleText,$titleImage,$selectIcon,$chooseIcon,$makeLink,$pinkLink)
    {
        $this->column = $column;
        $this->header = $header;
        $this->col = $col;
        $this->titleType = $titleType;
        $this->titleText = $titleText;
        $this->titleImage = $titleImage;
        $this->selectIcon = $selectIcon;
        $this->chooseIcon = $chooseIcon;
        $this->makeLink = $makeLink;
        $this->pinkLink = $pinkLink;
        $this->footers = $footers;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer-setting');
    }
}
