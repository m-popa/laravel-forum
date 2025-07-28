<div
    class="group bg-surface border border-gray rounded-xl p-6 max-w-full hover:border-primary/30 hover:shadow-lg transition-all duration-300 relative overflow-hidden">
    <!-- Subtle Background Pattern -->
    <div
        class="absolute inset-0 bg-gradient-to-br from-primary/2 via-transparent to-secondary/2 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

    <!-- Decorative Corner Element -->
    <div
        class="absolute top-0 right-0 w-12 h-12 bg-gradient-to-br from-primary/5 to-secondary/5 rounded-bl-full transform translate-x-4 -translate-y-4 group-hover:scale-110 transition-transform duration-300"></div>

    <div class="relative flex flex-col gap-5">
        <!-- Header: Avatar + User Info -->
        <div class="flex items-center gap-4">
            <x-user.avatar :user="$comment->user" size="w-10 h-10" :showOnline="true"/>

            <div class="min-w-0 flex-1">
                <h4 class="text-primary font-semibold truncate text-base group-hover:text-secondary transition-colors duration-300">
                    {{ $comment->user->name }}
                </h4>
                <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-3 h-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <span>{{ $comment->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>

        <!-- Reply Context (if replying to another comment) -->
        @if ($comment->parent)
            <div class="relative">
                <div class="flex items-start gap-3 p-4 bg-app/50 dark:bg-gray-800/30 rounded-lg border border-gray/50">
                    <!-- Reply Icon -->
                    <div
                        class="flex-shrink-0 w-6 h-6 bg-secondary/10 rounded-full flex items-center justify-center mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-3 h-3 text-secondary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"/>
                        </svg>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="text-xs text-secondary mb-2 font-medium">
                            {{ __('Replying to') }}
                            <span class="text-primary font-semibold">{{ $comment->parent->user->name }}</span>
                        </p>

                        <blockquote
                            class="text-sm text-gray-600 dark:text-gray-300 bg-surface/50 rounded-md border-l-3 border-secondary/30 pl-3 pr-3 py-2 italic leading-relaxed">
                            <div class="line-clamp-3">
                                {!! str()->markdown($comment->parent->preview_body) !!}
                            </div>
                        </blockquote>
                    </div>
                </div>
            </div>
        @endif

        <!-- Comment Content -->
        <div class="prose prose-sm dark:prose-invert max-w-none">
            <div class="text-gray-700 dark:text-gray-200 leading-relaxed">
                {{ $this->commentInfolist }}
            </div>
        </div>

        <!-- Actions Footer -->
        @if(auth()->check() && auth()->user()->can('reply', $comment))
            <div
                class="flex items-center justify-between pt-4 border-t border-gray/30 group-hover:border-primary/20 transition-colors duration-300">
                <!-- Voting (Left) -->
                @if($votingEnabled)
                    <div class="flex items-center">
                        <livewire:comment.vote-button
                            :comment="$comment"
                            wire:key="vote-{{ $comment->id }}"
                        />
                    </div>
                @endif

                <!-- Reply Button (Right) -->
                <button wire:click="replyToComment"
                        class="group/reply flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-primary hover:text-white hover:bg-primary rounded-lg transition-all duration-200 hover:shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor"
                         class="w-4 h-4 group-hover/reply:scale-110 transition-transform duration-200">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"/>
                    </svg>
                    {{ __('Reply') }}
                </button>
            </div>
        @endif
    </div>
</div>
