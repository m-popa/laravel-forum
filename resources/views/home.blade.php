<x-app-layout>
    {{-- Hero Section --}}
    <section
        class="relative bg-gradient-to-b from-violet-100 via-white to-gray-50 dark:from-gray-950 dark:via-gray-950 dark:to-gray-900">
        <div
            class="absolute inset-0 bg-gradient-to-r from-violet-300/10 to-indigo-400/10 dark:from-violet-800/10 dark:to-indigo-800/10 pointer-events-none"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-28 text-center">
            <h1 class="text-5xl sm:text-6xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-6">
                {{ $settings->hero_title }}
            </h1>
            <p class="text-lg text-gray-700 dark:text-gray-300 max-w-2xl mx-auto">
                {{ $settings->hero_subtitle }}
            </p>
        </div>
    </section>

    {{-- Categories Section --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-12">
            {{ $settings->categories_section_title }}
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($categories as $category)
                <a href="{{ route('categories.show', $category) }}"
                   class="group block bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-6 transition hover:shadow-xl hover:border-violet-500 dark:hover:border-violet-400">
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white group-hover:text-violet-700 dark:group-hover:text-violet-400 transition">
                            {{ $category->name }}
                        </h3>
                        @if ($category->description)
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                                {{ Str::limit($category->description, 100) }}
                            </p>
                        @endif
                    </div>
                    <div class="mt-4 text-sm font-medium text-violet-600 dark:text-violet-400 group-hover:underline">
                        View Threads →
                    </div>
                </a>
            @empty
                <div
                    class="col-span-full text-center py-12 bg-white dark:bg-gray-900 rounded-2xl border border-dashed border-gray-300 dark:border-gray-700">
                    <p class="text-gray-500 dark:text-gray-400 text-lg">
                        No categories available right now. Please check back later.
                    </p>
                </div>
            @endforelse
        </div>
    </section>
</x-app-layout>
