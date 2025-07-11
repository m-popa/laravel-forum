<div class="space-y-8 bg-white dark:bg-gray-900 mt-8" id="comments-wrapper">
    @forelse ($comments as $comment)
        <x-thread.comment-card :comment="$comment"/>
    @empty
        <p class="text-gray-500 dark:text-gray-400">
            {{ __('No comments yet. Be the first to comment!') }}
        </p>
    @endforelse

    {{ $comments->links(data: ['scrollTo' => '#comments-wrapper']) }}
</div>
