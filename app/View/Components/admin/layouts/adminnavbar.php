<?php

namespace App\View\Components\admin\layouts;

use Illuminate\View\Component;

class adminnavbar extends Component
{

    public $modulename;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modulename)
    {
        $this->modulename = $modulename;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.layouts.adminnavbar');
    }
}
