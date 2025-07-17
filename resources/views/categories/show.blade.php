<x-app-layout>
    <section
        class="relative bg-gradient-to-b from-violet-100 via-white to-gray-50 dark:from-gray-950 dark:via-gray-950 dark:to-gray-900">
        <div
            class="absolute inset-0 bg-gradient-to-r from-violet-300/10 to-indigo-400/10 dark:from-violet-800/10 dark:to-indigo-800/10 pointer-events-none"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-4">
                {{ $category->name }}
            </h1>

            @if ($category->description)
                <p class="text-lg text-gray-700 dark:text-gray-300 max-w-2xl mx-auto">
                    {{ $category->description }}
                </p>
            @endif

            <div class="mt-4">
                @auth
                    <a href="{{ route('threads.create', ['category' => $category]) }}"
                       class="inline-flex items-center justify-center px-4 py-2 bg-violet-600 hover:bg-violet-700 text-white text-sm font-medium rounded-xl transition w-full sm:w-auto">
                        + New Thread
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @forelse ($threads as $thread)
            <div
                class="mb-6 mx-auto max-w-4xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300 flex flex-col sm:flex-row sm:justify-between gap-6">
                <!-- Left Content: Title + Snippet -->
                <div class="flex-1 flex flex-col justify-between">
                    <a href="{{ $thread->url() }}"
                       class="block text-2xl font-semibold text-gray-900 dark:text-white hover:text-violet-600 dark:hover:text-violet-400 line-clamp-2 transition-colors"
                       tabindex="0">
                        {{ $thread->title }}
                    </a>

                    <p class="mt-3 text-gray-700 dark:text-gray-300 text-sm leading-relaxed line-clamp-3">
                        {{ $thread->preview_body }}
                    </p>
                </div>

                <!-- Right Content: Meta Info -->
                <div
                    class="flex flex-col sm:items-end justify-between min-w-[200px] gap-5 text-gray-500 dark:text-gray-400 text-sm">
                    <span class="whitespace-nowrap">
                        {{ $thread->created_at->diffForHumans() }}
                    </span>

                    <div class="flex items-center gap-4">
                        <!-- Author -->
                        <div class="flex items-center gap-3">
                            <img
                                src="{{ $thread->user->avatar_url }}"
                                alt="Jane Doe"
                                class="w-10 h-10 rounded-full border border-gray-300 dark:border-gray-700"
                                loading="lazy"
                            />
                            <span class="font-medium text-gray-800 dark:text-gray-200">Jane Doe</span>
                        </div>

                        <!-- Stats -->
                        <div class="flex gap-6">
                            <div
                                class="flex items-center gap-1 hover:text-violet-600 dark:hover:text-violet-400 cursor-pointer transition-colors"
                                aria-label="Views"
                                role="button"
                                tabindex="0"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <span>
                                    {{ $thread->views }}
                                </span>
                            </div>

                            <div
                                class="flex items-center gap-1 hover:text-violet-600 dark:hover:text-violet-400 cursor-pointer transition-colors"
                                aria-label="Comments"
                                role="button"
                                tabindex="0"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <path d="M17 8h2a2 2 0 012 2v7a2 2 0 01-2 2h-6l-4 4v-4H7a2 2 0 01-2-2v-1"/>
                                    <path d="M7 8V6a2 2 0 012-2h6a2 2 0 012 2v2"/>
                                </svg>
                                <span>
                                    {{ $thread->comments->count() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @empty
            <div
                class="text-center py-16 bg-white dark:bg-gray-900 border border-dashed border-gray-300 dark:border-gray-700 rounded-2xl">
                <p class="text-gray-500 dark:text-gray-400 text-lg">
                    No threads in this category yet.
                </p>
            </div>
        @endforelse


        <div class="mt-10">
            {{ $threads->links() }}
        </div>
    </section>
</x-app-layout>
