@props([
    'disabled' => false,
    'type' => 'text',
    'name' => null,
    'label' => null,
    'value' => null,
    'placeholder' => '',
    'size' => 'md'
])

@php
    $sizes = [
        'sm' => 'text-sm py-1 px-2',
        'md' => 'text-base py-2 px-3',
        'lg' => 'text-lg py-3 px-4',
    ];

    $sizeClasses = $sizes[$size] ?? $sizes['md'];
    $hasError = $name && $errors->has($name);

    $base = 'block w-full border bg-white rounded-lg shadow-sm focus:outline-none focus:ring-2 transition duration-150 ease-in-out';
    $focus = $hasError ? 'focus:ring-red-500 focus:border-red-500' : 'focus:ring-indigo-500 focus:border-indigo-500';
    $disabledClass = $disabled ? 'bg-gray-50 cursor-not-allowed text-gray-500' : '';
    $inputClasses = trim("{$base} {$focus} {$sizeClasses} {$disabledClass} border-gray-300 placeholder-gray-400");
@endphp

@if($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }}
    </label>
@endif

<div class="relative flex items-center">
    @if (isset($icon))
        <span class="absolute left-3 text-gray-400 pointer-events-none">
            {{ $icon }}
        </span>
    @endif

    <input
        id="{{ $name }}"
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {!! $disabled ? 'disabled' : '' !!}
        {!! $attributes->merge(['class' => $inputClasses . (isset($icon) ? ' pl-10' : '')]) !!}
    />

    @if (isset($append))
        <div class="ml-2">
            {{ $append }}
        </div>
    @endif
</div>

@if ($hasError)
    <p class="mt-1 text-sm text-red-600">{{ $errors->first($name) }}</p>
@endif
