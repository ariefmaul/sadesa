<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarLink extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct() {}

    /**
     * Render the sidebar navigation link view.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-link');
    }
}
