<div
    x-data="{
        scrollAndFocus() {
            $nextTick(() => {
                $refs.textArea?.scrollIntoView({ behavior: 'smooth', block: 'center' });
                $refs.textArea?.focus();
            });
        }
    }"
    @reply-to-comment.window="scrollAndFocus()">

    <h2 class="text-2xl font-bold text-gray-900 dark:text-white my-6">
        {{ __('Post a comment') }}
    </h2>

    @if ($parentId)
        <div
            class="mb-4 rounded-2xl border border-indigo-300/40 dark:border-indigo-700/50 bg-indigo-50/60 dark:bg-indigo-900/50 px-5 py-4 text-sm shadow-sm text-indigo-900 dark:text-indigo-100 flex flex-col gap-3">

            <div class="flex items-center justify-between">
                <div class="font-medium text-indigo-900 dark:text-indigo-100">
                    Replying to <span class="font-semibold">{{ $this->parentPreview['name'] ?? 'Unknown' }}</span>
                </div>

                <button
                    type="button"
                    wire:click="$set('parentId', null)"
                    class="rounded-md text-xs font-semibold px-2 py-1 bg-red-100 text-red-700 hover:bg-red-200 dark:bg-red-800 dark:text-white dark:hover:bg-red-700 transition"
                >
                    {{ __('Cancel') }}
                </button>
            </div>

            @if (!empty($this->parentPreview['preview']))
                <div>
                    {{ $this->parentPreview['preview'] }}
                </div>
            @endif
        </div>
    @endif


    <form wire:submit.prevent=" create">
        <div class="flex w-full flex-col gap-1 text-neutral-800 dark:text-neutral-300">
            <label for="textArea" class="w-fit pl-0.5 text-sm">
                {{ __('Comment') }}
            </label>
            <textarea id="textArea"
                      x-ref="textArea"
                      wire:model="body"
                      class="w-full rounded-xl border border-neutral-300 bg-neutral-200 px-3 py-2 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500 disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-purple-400"
                      rows="3" placeholder="What's on your mind?"></textarea>

            @error('body')
            <span class="text-sm text-red-500 dark:text-red-400">
                {{ $message }}
            </span>
            @enderror

            <button type="submit"
                    class="mt-4 self-start rounded-xl bg-primary border border-primary px-4 py-2 text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-primary-dark dark:border-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark">
                {{ __('Post a comment') }}
            </button>
        </div>
    </form>
</div>
