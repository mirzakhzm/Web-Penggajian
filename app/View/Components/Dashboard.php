<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dashboard extends Component
{
    /**
     * Create a new component instance.
     */
    public string $breadcrumb;
    public string $title;

    public function __construct(string $breadcrumb, string $title)
    {
        $this->breadcrumb = $breadcrumb;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard');
    }
}
