@props(['type' => 'info'])

@php
    $class = match ($type) {
        'info' => 'text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400',
        'danger' => 'text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400',
        'success' => 'text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400',
        'warning' => 'text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300',
        'Dark' => 'text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300',
    };
@endphp

<div {{ $attributes->merge(['class' => 'p-4 text-sm rounded-lg ' . $class]) }} role="alert">
    <span class="font-medium">{{ $title ?? 'info title' }}</span> {{ $slot }}
</div>
