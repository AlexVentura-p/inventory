<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BaseLayout extends Component
{
    public function render(): View
    {
        return view('layouts.base-layout');
    }
}
