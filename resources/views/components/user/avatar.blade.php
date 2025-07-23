@props([
    'user',
    'size' => 'w-12',
])
<div>

    @if($user->avatar_url)
        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
             class="size-12 ring-1 ring-primary rounded-full object-cover">
    @else
        <span class="flex size-12 items-center justify-center rounded-full border border-secondary">
            {{ $user->initials() }}
        </span>
    @endif
</div>
