<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert2 extends Component
{

    public $class;

    public function __construct($type = 'info')
    {
        $class = match ($type) {
            'info' => 'text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400',
            'danger' => 'text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400',
            'success' => 'text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400',
            'warning' => 'text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300',
            'Dark' => 'text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300',
        };
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert2');
    }
}