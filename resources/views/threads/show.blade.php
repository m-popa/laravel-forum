<x-app-layout>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4" id="comments-wrapper">
        <div class="mb-4">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                {{ $thread->title }}
            </h1>
            <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                {{__('Posted by')}} {{ $thread->user->name }} • {{ $thread->created_at->diffForHumans() }}
            </p>
        </div>

        <livewire:comment.list-comments :thread="$thread"/>

        @auth
            <livewire:comment.create-comment :thread-id="$thread->id"/>
        @else
            <p class="text-gray-500 dark:text-gray-400 mt-4">
                <a href="{{ route('login') }}" class="text-primary">
                    {{ __('Log in') }}
                </a>

                {{ __('or') }}

                <a href="{{ route('register') }}"
                   class="text-primary">
                    {{ __('Register') }}
                </a>
                {{ __('to leave a comment.') }}
            </p>
        @endauth
    </section>
</x-app-layout>


