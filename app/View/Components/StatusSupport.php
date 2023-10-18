<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusSupport extends Component
{
    public string $statusText;

    public string $statusColor;

    const STATUS_COLOR = [
        'A' => 'blue',
        'C' => 'green',
        'P' => 'red',
    ];

    /**
     * Create a new component instance.
     */
    public function __construct(
        protected string $status,
    ) {
        $this->statusColor = self::STATUS_COLOR[$this->status];
        $this->statusText = getStatusSupport($this->status);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.status-support');
    }
}
