<div
    id="comment-form-container"
    x-data="{
        scrollAndFocus() {
            this.$nextTick(() => {
                const el = document.getElementById('comment-form-container');
                el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                // Optional: focus on the first form input
                const firstInput = el.querySelector('input, textarea');
                if (firstInput) {
                    setTimeout(() => firstInput.focus(), 500);
                }
            });
        }
    }"
    @reply-to-comment.window="scrollAndFocus()"
    class="bg-surface border border-gray rounded-xl shadow-sm transition-all duration-300 mt-8"
>
    <!-- Header Section -->
    <div class="px-4 sm:px-6 py-4 border-b border-gray">
        <div class="flex items-center gap-3">
            <div
                class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white"
                     class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white">
                    {{ __('Post a comment') }}
                </h2>
                <p class="text-secondary text-sm">
                    Share your thoughts
                </p>
            </div>
        </div>
    </div>

    <div class="p-4 sm:p-6">
        <!-- Reply Context Banner -->
        @if ($parentId)
            <div class="mb-6">
                <div class="bg-primary/5 border border-primary/20 rounded-lg p-4 relative">
                    <!-- Decorative line -->
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary rounded-l-lg"></div>

                    <!-- Header -->
                    <div class="flex items-center justify-between gap-3 mb-3">
                        <div class="flex items-center gap-2 min-w-0 flex-1">
                            <div class="w-6 h-6 bg-primary/10 rounded flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-3 h-3 text-primary">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"/>
                                </svg>
                            </div>
                            <span class="text-xs text-secondary">{{ __('Replying to') }}</span>
                            <span class="font-medium text-primary text-sm truncate">
                                {{ $this->parentPreview['name'] }}
                            </span>
                        </div>

                        <button
                            type="button"
                            wire:click="$set('parentId', null)"
                            class="text-danger hover:bg-danger hover:text-white p-1 rounded transition-all duration-200"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Preview Content -->
                    <div class="bg-surface rounded p-3 text-xs text-secondary italic line-clamp-2">
                        {{ $this->parentPreview['preview'] }}
                    </div>
                </div>
            </div>
        @endif

        <!-- Comment Form -->
        <form wire:submit="create" class="space-y-4">
            <!-- Form Fields Container -->
            <div>
                {{ $this->form }}
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button
                    type="submit"
                    id="comment-button"
                    class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-primary to-secondary hover:from-secondary hover:to-primary text-white font-medium rounded-lg transition-all duration-200 text-sm"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                         stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/>
                    </svg>
                    {{ __('Post Comment') }}
                </button>
            </div>
        </form>
    </div>

    <x-filament-actions::modals/>
</div>
