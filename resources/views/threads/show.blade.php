<x-app-layout>
    <section
        class="relative bg-gradient-to-b from-violet-100 via-white to-gray-50 dark:from-gray-950 dark:via-gray-950 dark:to-gray-900">
        <div
            class="absolute inset-0 bg-gradient-to-r from-violet-300/10 to-indigo-400/10 dark:from-violet-800/10 dark:to-indigo-800/10 pointer-events-none"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                {{ $thread->title }}
            </h1>
            <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                Posted by {{ $thread->user->name }} • {{ $thread->created_at->diffForHumans() }}
            </p>
        </div>
    </section>

    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <article
            class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-8 shadow-sm transition">
            <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200">
                {!! str($thread->content)->markdown()->sanitizeHtml() !!}
            </div>
        </article>


        <livewire:thread.list-replies :thread-id="$thread->id"/>

        <livewire:thread.create-reply :thread-id="$thread->id"/>

    </section>
</x-app-layout>
