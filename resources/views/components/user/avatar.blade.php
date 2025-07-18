@props([
    'user',
    'size' => 'w-12',
])
<div>
    @if($user->avatar_url)
        <img class="size-14 rounded-full object-cover"
             src="{{ $user->avatar_url }}" alt="{{ $user->name }}">

    @else
        <span
            class="flex size-12 items-center justify-center overflow-hidden rounded-full border border-outline bg-surface-alt text-sm font-bold tracking-wider text-on-surface/80 dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark/80">
            {{ $user->initials() }}
        </span>

    @endif
</div>
