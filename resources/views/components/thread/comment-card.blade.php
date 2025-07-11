@php
    use App\Models\Comment;
    /** @var Comment $comment */
@endphp

@props(['comment'])

<div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-5 shadow-sm">
    <div class="flex items-start gap-4">
        <img src="https://i.pravatar.cc/40?u={{ $comment->user->id }}"
             class="w-10 h-10 rounded-full"
             alt="{{ $comment->user->name }}">

        <div class="flex-1">
            <div class="text-sm font-semibold text-gray-900 dark:text-white">
                {{ $comment->user->name }}
            </div>

            @if ($comment->parent)
                <div class="mt-2">
                    <div class="text-xs text-gray-500 dark:text-gray-400 italic mb-1">
                        Replying to <span class="font-semibold">{{ $comment->parent->user->name }}</span>:
                    </div>
                    <blockquote
                        class="text-sm text-gray-700 dark:text-gray-300 bg-indigo-50 dark:bg-gray-800 p-3 rounded-md border-l-4 border-indigo-400">
                        {{ $comment->parent->preview_body }}
                    </blockquote>
                </div>
            @endif

            <div class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                {{ $comment->body }}
            </div>

            <div class="flex items-center justify-between mt-3 text-xs text-gray-500 dark:text-gray-400">
                <span>Posted {{ $comment->created_at->diffForHumans() }}</span>

                <div class="flex gap-3">
                    <button class="hover:text-indigo-600 dark:hover:text-indigo-400">Like</button>
                    <button
                        x-data
                        x-on:click="$dispatch('reply-to-comment', { parentId: {{ $comment->id }} })"
                        class="hover:text-indigo-600 dark:hover:text-indigo-400"
                    >
                        Reply
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
