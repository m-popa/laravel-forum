<x-app-layout>
    <x-page-header :title="$settings->hero_title" :subtitle="$settings->hero_subtitle"/>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-12">
            {{ $settings->categories_section_title }}
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($categories as $category)
                <article
                    class="group grid rounded-xl max-w-2xl grid-cols-1 md:grid-cols-8 overflow-hidden border border-secondary">
                    <a href="{{ route('threads.index', $category) }}">
                        <div class="flex flex-col justify-center p-6 col-span-8">
                            <h3 class="text-balance text-xl font-bold text-on-surface-strong lg:text-2xl dark:text-on-surface-dark-strong"
                                aria-describedby="articleDescription">
                                {{ $category->name }}
                            </h3>
                            <p id="articleDescription" class="my-4 max-w-lg text-pretty text-sm">
                                {{ $category->description }}
                            </p>
                            <a href="{{ route('threads.index', $category) }}"
                               class="w-fit font-medium text-primary dark:text-primary-dark">
                                {{ __('View Threads') }}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                                     fill="none" stroke-width="2.5" aria-hidden="true" class="inline size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                                </svg>
                            </a>
                        </div>
                    </a>
                </article>
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
