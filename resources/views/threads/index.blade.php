<x-app-layout>
    <x-page-header :title="$category->name" :subtitle="$category->description">
        <div class="mt-6">
            @auth
                <a href="{{ route('threads.create', ['category' => $category]) }}"
                   class="inline-flex items-center justify-center px-5 py-2.5 bg-primary hover:bg-secondary text-white font-medium rounded-lg shadow-sm hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                         stroke="currentColor" class="w-4 h-4 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    New Thread
                </a>
            @endauth
        </div>
    </x-page-header>

    <section x-data="{ sidebarOpen: false }" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Mobile Toggle Button -->
        <div class="lg:hidden mb-6">
            <button @click="sidebarOpen = !sidebarOpen"
                    class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg shadow hover:bg-secondary transition-all duration-200">
                <template x-if="!sidebarOpen">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </template>
                <template x-if="sidebarOpen">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </template>
                <span x-text="sidebarOpen ? 'Hide Sidebar' : 'Show Sidebar'"></span>
            </button>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar -->
            <aside :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }"
                   class="lg:block w-full lg:w-80 space-y-6 order-1 transition-all duration-200">

                <!-- Search -->
                <div class="bg-surface border border-gray rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Search Threads</h3>
                    <form class="relative">
                        <input type="search"
                               placeholder="Search discussions..."
                               class="w-full pl-10 pr-4 py-3 bg-app border border-gray rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200 text-gray-900 dark:text-white placeholder-gray-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                            </svg>
                        </div>
                    </form>
                </div>

                <!-- Categories -->
                <div class="bg-surface border border-gray rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        {{ __('Categories') }}
                    </h3>
                    <div class="space-y-2">
                        @foreach ($categories as $category)
                            <a href="{{ route('threads.index', $category) }}"
                               class="flex items-center justify-between p-3 rounded-lg hover:bg-primary/10 hover:border-primary/20 border border-transparent transition-all duration-200 group">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 bg-primary rounded-full"></div>
                                    <span class="font-medium text-gray-700 dark:text-gray-200 group-hover:text-primary">
                                        {{ $category->name }}
                                    </span>
                                </div>

                                <span class="text-xs text-gray-500 bg-gray/20 px-2 py-1 rounded-full">
                                    {{ $category->threads()->count() }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                    <div class="pt-4 mt-4 border-t border-primary/50">
                        <a href="#"
                           class="text-sm text-primary hover:text-secondary font-medium transition-colors duration-200">
                            {{ __('View all categories') }}
                        </a>
                    </div>
                </div>

                <!-- Stats -->
                <div class="bg-surface border border-gray rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Community Stats</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-secondary">Total Threads</span>
                            <span class="font-semibold text-primary">1,247</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-secondary">Total Comments</span>
                            <span class="font-semibold text-secondary">8,932</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-secondary">Active Users</span>
                            <span class="font-semibold text-success">423</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-secondary">Online Now</span>
                            <span class="font-semibold text-info">67</span>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 order-2">
                @forelse ($threads as $thread)
                    <article
                        class="mb-6 bg-surface border border-gray rounded-xl hover:border-primary/40 hover:shadow-lg transition-all duration-200">
                        <div class="p-6">
                            <a href="{{ $thread->url() }}" class="block mb-4 group">
                                <h2 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-white group-hover:text-primary transition-colors duration-200 line-clamp-2">
                                    {{ $thread->title }}
                                </h2>
                            </a>

                            <div class="prose prose-sm max-w-none text-gray-600 dark:text-gray-300 mb-6">
                                <div class="line-clamp-3 leading-relaxed">
                                    {!! str()->markdown($thread->preview_body) !!}
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="flex items-center gap-6 text-sm text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center gap-1.5">
                                        <x-heroicon-o-eye class="w-4 h-4"/>
                                        <span>{{ number_format($thread->views) }}</span>
                                    </div>

                                    <div class="flex items-center gap-1.5">
                                        <x-heroicon-o-chat-bubble-left class="w-4 h-4"/>
                                        <span>{{ $thread->comments->count() }}</span>
                                    </div>

                                    <div class="flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                        <span>{{ $thread->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-gray/50">
                                    <div class="flex items-center gap-3">
                                        <x-user.avatar :user="$thread->user" class="w-8 h-8"/>
                                        <span class="font-medium text-primary truncate w-32">
                                            {{ $thread->user->name }}
                                        </span>
                                    </div>

                                    <a href="{{ $thread->url() }}"
                                       class="text-sm text-primary hover:text-secondary font-medium transition-colors duration-200">
                                        Read more →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="text-center">
                        <div class="bg-surface rounded-xl border border-dashed border-gray p-12">
                            <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-3">
                                No threads yet
                            </h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-6">
                                Be the first to start a discussion in this category.
                            </p>
                        </div>
                    </div>
                @endforelse

                <div class="mt-12">
                    {{ $threads->links() }}
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
