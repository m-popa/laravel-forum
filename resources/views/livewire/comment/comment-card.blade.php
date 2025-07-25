<div class="border border-secondary rounded-xl p-5 max-w-full">
    <div class="flex flex-col gap-4">
        <div class="flex items-center gap-3">
            <x-user.avatar :user="$comment->user"/>

            <div class="min-w-0">
                <h4 class="text-primary font-semibold truncate">
                    {{ $comment->user->name }}
                </h4>
                <span class="text-xs text-primary">
                    {{ $comment->created_at->diffForHumans() }}
                </span>
            </div>
        </div>

        @if ($comment->parent)
            <div class="mt-2">
                <p class="text-xs italic text-gray-500 dark:text-gray-400 mb-1">
                    {{ __('Replying to') }}
                    <span class="font-semibold text-primary">
                        {{ $comment->parent->user->name }}
                    </span>
                </p>

                <blockquote
                    class="text-sm text-base-200 bg-secondary rounded border-l-8 border-accent pl-3 pr-4 py-3 break-words">
                    {!! str()->markdown($comment->parent->preview_body) !!}
                </blockquote>
            </div>
        @endif

        <p class="text-sm prose dark:prose-invert">
            {{ $this->commentInfolist }}
        </p>

        @if(auth()->check() && auth()->user()->can('reply', $comment))
            <div class="mt-4 flex items-center justify-between text-xs">
                <livewire:comment.vote-button
                    :comment="$comment"
                    wire:key="vote-{{ $comment->id }}"
                />

                <button wire:click="replyToComment" class="font-medium text-primary whitespace-nowrap hover:underline">
                    {{ __('Reply') }}
                </button>
            </div>
        @endif
    </div>
</div>
