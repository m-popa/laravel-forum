<div
    class="space-y-8 bg-white dark:bg-gray-900 mt-8">
    @forelse ($comments as $comment)
        <x-thread.comment-card :comment="$comment"/>
    @empty
        <p class="text-gray-500 dark:text-gray-400">No replies yet. Be the first to comment!</p>
    @endforelse
</div>
