@props([
    'user',
    'size' => 'w-12 h-12',
])

<div class="inline-flex items-center justify-center {{ $size }} rounded-full overflow-hidden ring-1 ring-primary">
    @if ($user->avatar_url)
        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
             class="object-cover w-full h-full rounded-full"/>
    @else
        <span
            class="flex w-full h-full items-center justify-center rounded-full bg-surface text-primary font-medium uppercase">
            {{ $user->initials() }}
        </span>
    @endif
</div>
