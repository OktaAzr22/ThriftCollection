<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BrandBadge extends Component
{
    public $brand;
    /**
     * Create a new component instance.
     */
    public function __construct($brand)
    {
        $this->brand = $brand;
    }

    public function textColor($hex)
    {
        if (!$hex) {
            return '#000';
        }

        $hex = str_replace('#', '', $hex);
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        $luminance = (0.299*$r + 0.587*$g + 0.114*$b);

        return $luminance > 150 ? '#000000' : '#ffffff';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.brand-badge');
    }
}
