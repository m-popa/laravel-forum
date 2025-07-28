@props([
    'user',
    'size' => 'w-12 h-12',
    'showOnline' => false,
    'shadow' => true,
])

@php
    $sizeClasses = [
        'w-6 h-6' => 'text-xs',
        'w-8 h-8' => 'text-sm',
        'w-10 h-10' => 'text-sm',
        'w-12 h-12' => 'text-base',
        'w-16 h-16' => 'text-lg',
        'w-20 h-20' => 'text-xl',
        'w-24 h-24' => 'text-2xl',
    ];

    $textSize = $sizeClasses[$size] ?? 'text-base';
    $shadowClass = $shadow ? 'shadow-md hover:shadow-lg' : '';
@endphp

<div class="relative inline-flex items-center justify-center {{ $size }} group">
    <!-- Main Avatar Container -->
    <div
        class="relative {{ $size }} rounded-full overflow-hidden ring-2 ring-gray/20 group-hover:ring-primary/40 {{ $shadowClass }} transition-all duration-300 bg-gradient-to-br from-surface to-app">
        @if ($user->avatar_url)
            <img src="{{ $user->avatar_url }}"
                 alt="{{ $user->name }}"
                 class="object-cover w-full h-full rounded-full group-hover:scale-105 transition-transform duration-300"/>
        @else
            <!-- Gradient Background for Initials -->
            <div
                class="absolute inset-0 bg-gradient-to-br from-primary/20 via-primary/10 to-secondary/20 rounded-full"></div>

            <!-- Initials -->
            <span
                class="relative flex w-full h-full items-center justify-center {{ $textSize }} font-semibold text-primary dark:text-primary group-hover:text-secondary dark:group-hover:text-secondary transition-colors duration-300 uppercase tracking-wide">
                {{ $user->initials() }}
            </span>
        @endif

        <!-- Hover Overlay -->
        <div
            class="absolute inset-0 bg-primary/10 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    </div>

    <!-- Online Status Indicator -->
    @if ($showOnline)
        <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-success rounded-full border-2 border-surface shadow-sm">
            <div class="w-full h-full bg-success rounded-full animate-pulse"></div>
        </div>
    @endif

    <!-- Decorative Ring (appears on hover) -->
    <div
        class="absolute inset-0 rounded-full border-2 border-primary/0 group-hover:border-primary/20 transition-all duration-300 scale-110"></div>
</div>
