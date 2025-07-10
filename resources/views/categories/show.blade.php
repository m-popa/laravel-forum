<x-app-layout>
    <section
        class="relative bg-gradient-to-b from-violet-100 via-white to-gray-50 dark:from-gray-950 dark:via-gray-950 dark:to-gray-900">
        <div
            class="absolute inset-0 bg-gradient-to-r from-violet-300/10 to-indigo-400/10 dark:from-violet-800/10 dark:to-indigo-800/10 pointer-events-none"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-4">
                {{ $category->name }}
            </h1>
            @if ($category->description)
                <p class="text-lg text-gray-700 dark:text-gray-300 max-w-2xl mx-auto">
                    {{ $category->description }}
                </p>
            @endif
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">
                Threads in "{{ $category->name }}"
            </h2>
            @auth
                <a href="{{ route('threads.create', ['category' => $category]) }}"
                   class="inline-flex items-center px-4 py-2 bg-violet-600 hover:bg-violet-700 text-white text-sm font-medium rounded-xl transition">
                    + New Thread
                </a>
            @endauth
        </div>

        @forelse ($threads as $thread)
            <div
                class="mb-6 mx-auto bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-5 sm:p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col gap-5">

                <!-- Title and Time -->
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2 sm:gap-4">
                    <a href="{{ route('threads.show', ['thread' => $thread, 'category' => $category]) }}"
                       class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white hover:text-violet-600 dark:hover:text-violet-400 transition-colors line-clamp-2">
                        {{ $thread->title }}
                    </a>
                    <span class="text-xs text-gray-500 dark:text-gray-400 sm:whitespace-nowrap sm:text-sm min-w-max">
                        {{ $thread->created_at->diffForHumans() }}
                    </span>
                </div>

                <!-- Preview Snippet -->
                <p class="text-sm leading-relaxed text-gray-700 dark:text-gray-300 line-clamp-3">
                    {{ $thread->preview_body }}
                </p>

                <!-- Author and Meta Info -->
                <div
                    class="flex flex-col sm:flex-row sm:justify-between items-start sm:items-center gap-5 text-sm text-gray-500 dark:text-gray-400 mt-auto">

                    <!-- Author -->
                    <div class="flex items-center gap-3">
                        <img src="https://i.pravatar.cc/40?u=author@example.com" alt="Author avatar"
                             class="w-9 h-9 rounded-full border border-gray-300 dark:border-gray-700">
                        <span class="font-medium text-gray-700 dark:text-gray-300">
                            {{ $thread->user->name }}
                        </span>
                    </div>

                    <!-- Stats -->
                    <div class="flex gap-6 text-gray-500 dark:text-gray-400">

                        <!-- Views -->
                        <div
                            class="flex items-center gap-1 hover:text-violet-600 dark:hover:text-violet-400 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 4.5C7.5 4.5 3.735 8.015 2.25 12c1.485 3.985 5.25 7.5 9.75 7.5s8.265-3.515 9.75-7.5C20.265 8.015 16.5 4.5 12 4.5zM12 15a3 3 0 100-6 3 3 0 000 6z"/>
                            </svg>
                            <span>{{ $thread->views }}</span>
                        </div>

                        <!-- Replies -->
                        <div
                            class="flex items-center gap-1 hover:text-violet-600 dark:hover:text-violet-400 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M7 8h10M7 12h6m-6 4h4m9-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ $thread->replies->count() }} replies</span>
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
