@props(['user'])

@if($user->avatar_url)
    <div class="avatar">
        <div class="w-12 rounded-full">
            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}"/>
        </div>
    </div>
@else
    <div class="avatar avatar-placeholder">
        <div class="bg-neutral text-neutral-content w-12 rounded-full">
            <span>{{ $user->initials() }}</span>
        </div>
    </div>
@endif
