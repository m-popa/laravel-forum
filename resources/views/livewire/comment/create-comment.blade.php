<div
    x-data="{
        scrollAndFocus() {
            this.$nextTick(() => {
                const el = document.getElementById('comment-editor');

                el.scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
        }
    }"
    @reply-to-comment.window="scrollAndFocus()"
>


    <h2 class="text-2xl font-bold text-gray-900 dark:text-white my-6">
        {{ __('Post a comment') }}
    </h2>

    @if ($parentId)
        <div
            class="mb-4 rounded-2xl border border-indigo-300/40 dark:border-indigo-700/50 bg-indigo-50/60 dark:bg-indigo-900/50 px-5 py-4 text-sm shadow-sm text-indigo-900 dark:text-indigo-100 flex flex-col gap-3">

            <div class="flex items-center justify-between">
                <div class="font-medium text-indigo-900 dark:text-indigo-100">
                    Replying to
                    <span class="font-semibold">
                        {{ $this->parentPreview['name'] }}
                    </span>
                </div>

                <button
                    type="button"
                    wire:click="$set('parentId', null)"
                    class="rounded-md text-xs font-semibold px-2 py-1 bg-red-100 text-red-700 hover:bg-red-200 dark:bg-red-800 dark:text-white dark:hover:bg-red-700 transition"
                >
                    {{ __('Cancel') }}
                </button>
            </div>

            <div>
                {{ $this->parentPreview['preview'] }}
            </div>
        </div>
    @endif


    <form wire:submit.prevent="create">
        <div class="flex w-full flex-col gap-1 ">
            {{ $this->form }}

            <button type="submit" id="comment-editor" class="btn btn-primary my-4">
                {{ __('Post a comment') }}
            </button>
        </div>
    </form>
</div>
