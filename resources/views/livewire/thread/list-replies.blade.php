<div>
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white my-6">
        Replies
    </h2>

    <div
        class="space-y-8 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-6">
        @forelse ($replies as $reply)
            <x-thread.reply :reply="$reply"/>
        @empty
            <p class="text-gray-500 dark:text-gray-400">No replies yet. Be the first to reply!</p>
        @endforelse
    </div>
</div>
