<div class="inline-flex items-center gap-3">
    <!-- Upvote Button -->
    <button
        type="button"
        wire:click="vote(true)"
        class="inline-flex shrink-0 justify-center items-center size-8 rounded-full
            text-gray-500
            dark:text-neutral-500
            {{ $userVote === true ? 'btn-success btn dark:text-white' : '' }}">
        <!-- Upvote SVG icon -->
        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M7 10v12"></path>
            <path
                d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"></path>
        </svg>
    </button>

    <!-- Votes count -->
    <span class="text-sm font-semibold select-none">
        {{ $votesCount }}
    </span>

    <!-- Downvote Button -->
    <button
        type="button"
        wire:click="vote(false)"
        class="inline-flex shrink-0 justify-center items-center size-8 rounded-full
            text-gray-500
            dark:text-neutral-500
            {{ $userVote === false ? 'btn btn-error dark:text-white' : '' }}">
        <!-- Downvote SVG icon -->
        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 14V2"></path>
            <path
                d="M9 18.12 10 14H4.17a2 2 0 0 1-1.92-2.56l2.33-8A2 2 0 0 1 6.5 2H20a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.76a2 2 0 0 0-1.79 1.11L12 22h0a3.13 3.13 0 0 1-3-3.88Z"></path>
        </svg>
    </button>
</div>
