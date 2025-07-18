<x-app-layout>
    <x-page-header :title="$category->name" :subtitle="$category->description">
        <div class="mt-4">
            @auth
                <a href="{{ route('threads.create', ['category' => $category]) }}"
                   class="inline-flex items-center justify-center px-4 py-2">
                    + New Thread
                </a>
            @endauth
        </div>
    </x-page-header>


    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @forelse ($threads as $thread)
            <div
                class="mb-6 mx-auto max-w-7xl border border-secondary p-6 rounded-xl">
                <!-- Left Content: Title + Snippet -->
                <div class="flex-1 flex flex-col justify-between">
                    <a href="{{ $thread->url() }}" class="block text-2xl font-semibold line-clamp-2 lg:text-2xl">
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
                            <x-user.avatar :user="$thread->user"/>
                            <span class="font-medium text-gray-800 dark:text-gray-200">
                                {{ $thread->user->name }}
                            </span>
                        </div>

                        <!-- Stats -->
                        <div class="flex gap-6">
                            <div
                                class="flex items-center gap-1 hover:text-primary dark:hover:text-primary cursor-pointer transition-colors"
                                aria-label="Views"
                                role="button"
                                tabindex="0">

                                <x-heroicon-o-eye class="w-5 h-5"/>
                                <span>
                                    {{ $thread->views }}
                                </span>
                            </div>

                            <div
                                class="flex items-center gap-1 hover:text-primary dark:hover:text-primary cursor-pointer transition-colors"
                                aria-label="Comments"
                                role="button"
                                tabindex="0">

                                <x-heroicon-o-chat-bubble-left class="w-5 h-5"/>
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
                class="text-center py-16 bg-white dark:bg-surface-dark border border-dashed border-surface-dark dark:border-surface-alt rounded-lg">
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
