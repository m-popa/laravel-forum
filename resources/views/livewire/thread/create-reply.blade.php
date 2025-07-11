<div>
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white my-6">
        Post a comment
    </h2>

    <form wire:submit.prevent="create">
        <div class="flex w-full flex-col gap-1 text-neutral-800 dark:text-neutral-300">
            <label for="textArea" class="w-fit pl-0.5 text-sm">Comment</label>
            <textarea id="textArea"
                      wire:model="body"
                      class="w-full rounded-xl border border-neutral-300 bg-neutral-200 px-2.5 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500 disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-purple-400"
                      rows="3" placeholder="What's on your mind?">
            </textarea>

            @error('body')
            <span class="text-sm text-red-500 dark:text-red-400">
                {{ $message }}
            </span>
            @enderror

            <button type="submit"
                    class="mt-4 whitespace-nowrap rounded-xl bg-primary border border-primary px-4 py-2 text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-primary-dark dark:border-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark">
                Post a comment
            </button>
        </div>

    </form>
</div>
