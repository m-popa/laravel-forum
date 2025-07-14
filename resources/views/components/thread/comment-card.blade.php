@php
    use App\Models\Comment;
    /** @var Comment $comment */
@endphp

@props(['comment'])

<div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-5 shadow-md max-w-full">
    <div class="flex flex-col gap-4">
        <!-- Header: avatar + name + timestamp -->
        <div class="flex items-center gap-3">
            <img
                src="{{ $comment->user->avatar_url }}"
                alt="{{ $comment->user->name }}"
                class="w-12 h-12 rounded-full object-cover flex-shrink-0"
            />
            <div class="min-w-0">
                <h4 class="text-base font-semibold text-gray-900 dark:text-white truncate">
                    {{ $comment->user->name }}
                </h4>
                <span class="text-xs text-gray-500 dark:text-gray-400">
                    {{ $comment->created_at->diffForHumans() }}
                </span>
            </div>
        </div>

        <!-- Parent reply if any -->
        @if ($comment->parent)
            <div class="mt-2">
                <p class="text-xs italic text-gray-500 dark:text-gray-400 mb-1">
                    Replying to <span class="font-semibold text-indigo-600 dark:text-indigo-400">
                        {{ $comment->parent->user->name }}
                    </span>:
                </p>
                <blockquote
                    class="text-sm text-gray-700 dark:text-gray-300 bg-indigo-50 dark:bg-gray-800 rounded border-l-4 border-indigo-400 pl-3 pr-4 py-3 break-words">
                    {{ $comment->parent->preview_body }}
                </blockquote>
            </div>
        @endif

        <!-- Comment body -->
        <p class="text-sm text-gray-800 dark:text-gray-300">
            {{ $comment->body }}
        </p>

        @auth
            <!-- Bottom row: votes left, reply button right -->
            <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 mt-4">
                @if (auth()->id() !== $comment->user_id)
                    <livewire:comment.vote-button :comment="$comment" :wire:key="'vote-'.$comment->id"/>

                    <button
                        x-data
                        x-on:click="$dispatch('reply-to-comment', { parentId: {{ $comment->id }} })"
                        class="text-indigo-600 dark:text-indigo-400 font-medium whitespace-nowrap hover:underline"
                    >
                        {{ __('Reply') }}
                    </button>
                @endif
            </div>
        @endauth
    </div>
</div>
