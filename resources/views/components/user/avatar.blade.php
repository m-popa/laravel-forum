@props([
    'user',
    'size' => 'w-12',
])
<div>
    @if($user->avatar_url)
        <div class="avatar">
            <div class="{{ $size }} rounded-full">
                <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}"/>
            </div>
        </div>
    @else
        <div class="avatar avatar-placeholder">
            <div class="bg-neutral text-neutral-content {{ $size }} rounded-full">
                <span>{{ $user->initials() }}</span>
            </div>
        </div>
    @endif
</div>
