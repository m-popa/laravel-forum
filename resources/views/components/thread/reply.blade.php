@props(['reply'])

<div class="flex items-start gap-4">
    <img src="https://i.pravatar.cc/40?u={{ $reply->user->id }}" class="w-10 h-10 rounded-full"
         alt="{{ $reply->user->name }}">

    <div class="flex-1">
        <div class="text-sm font-semibold text-gray-900 dark:text-white">
            {{ $reply->user->name }}
        </div>

        @if ($reply->parent)
            <div class="mt-2">
                <div class="text-xs text-gray-500 dark:text-gray-400 italic mb-1">
                    Replying to <span class="font-semibold">{{ $reply->parent->user->name }}</span>:
                </div>
                <blockquote
                    class="text-sm text-gray-700 dark:text-gray-300 bg-indigo-50 dark:bg-gray-800 p-3 rounded-md border-l-4 border-indigo-400">
                    {{ $reply->parent->preview_body }}
                </blockquote>
            </div>
        @endif

        <div class="mt-2 text-sm text-gray-700 dark:text-gray-300">
            {{ $reply->body }}
        </div>

        <div class="text-xs text-gray-500 dark:text-gray-400 mt-2">
            Posted {{ $reply->created_at->diffForHumans() }}
        </div>
    </div>
</div>
