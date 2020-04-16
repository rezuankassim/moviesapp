<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $textColor;
    public $backgroundColor;
    public $hoverTextColor;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($textColor, $backgroundColor, $hoverTextColor)
    {
        $this->textColor = $textColor;
        $this->backgroundColor = $backgroundColor;
        $this->hoverTextColor = $hoverTextColor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
