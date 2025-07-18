<x-app-layout>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4" id="comments-wrapper">
        <div class="mb-4">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                {{ $thread->title }}
            </h1>
            <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                Posted by {{ $thread->user->name }} • {{ $thread->created_at->diffForHumans() }}
            </p>
        </div>

        <article
            class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-8 shadow-sm transition">

            <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200">
                {!! str($thread->content)->markdown()->sanitizeHtml() !!}
            </div>
        </article>

        <livewire:thread.list-comments :thread-id="$thread->id"/>

        @auth
            <livewire:thread.create-comment :thread-id="$thread->id"/>
        @else
            <p class="text-gray-500 dark:text-gray-400 mt-4">
                <a href="{{ route('login') }}" class="text-primary">Log in</a> or
                <a href="{{ route('register') }}" class="text-primary">register</a> to post a reply.
            </p>
        @endauth

    </section>
</x-app-layout>


