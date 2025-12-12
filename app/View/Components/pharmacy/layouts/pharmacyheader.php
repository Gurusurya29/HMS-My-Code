<?php

namespace App\View\Components\pharmacy\layouts;

use Illuminate\View\Component;

class pharmacyheader extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pharmacy.layouts.pharmacyheader');
    }
}
