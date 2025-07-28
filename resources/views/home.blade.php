<x-app-layout>
    <x-page-header :title="$settings->hero_title" :subtitle="$settings->hero_subtitle"/>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold bg-gradient-to-r from-primary via-secondary to-primary bg-clip-text text-transparent mb-4">
                {{ $settings->categories_section_title }}
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto rounded-full"></div>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            @forelse ($categories as $category)
                <article
                    class="group relative bg-surface border border-gray rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-primary/10 hover:-translate-y-2 hover:border-primary/20">
                    <!-- Background Pattern -->
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-primary/5 via-transparent to-secondary/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <!-- Decorative Element -->
                    <div
                        class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-primary/10 to-secondary/10 rounded-bl-full transform translate-x-8 -translate-y-8 group-hover:scale-110 transition-transform duration-300"></div>

                    <a href="{{ route('threads.index', $category) }}" class="block relative p-8 h-full">
                        <div class="flex flex-col h-full">
                            <!-- Category Icon/Badge -->
                            <div class="flex items-center justify-between mb-6">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-primary to-secondary rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-primary/25 transition-shadow duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                         stroke="white" stroke-width="2" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"/>
                                    </svg>
                                </div>
                                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                                         fill="none" stroke-width="2" class="w-5 h-5 text-primary">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 group-hover:text-primary dark:group-hover:text-primary transition-colors duration-300">
                                    {{ $category->name }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-300 leading-relaxed mb-6 flex-1">
                                    {{ $category->description }}
                                </p>
                            </div>

                            <!-- CTA -->
                            <div
                                class="flex items-center justify-between pt-4 border-t border-gray/50 group-hover:border-primary/20 transition-colors duration-300">
                                <span
                                    class="font-semibold text-primary dark:text-primary group-hover:text-secondary dark:group-hover:text-secondary transition-colors duration-300">
                                    {{ __('View Threads') }}
                                </span>
                                <div
                                    class="w-8 h-8 bg-primary/10 dark:bg-primary/20 rounded-full flex items-center justify-center group-hover:bg-primary group-hover:scale-110 transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                                         fill="none" stroke-width="2.5"
                                         class="w-4 h-4 text-primary group-hover:text-white transition-colors duration-300">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                </article>
            @empty
                <div class="col-span-full">
                    <div
                        class="text-center py-20 bg-gradient-to-br from-surface via-app to-surface rounded-3xl border border-dashed border-gray relative overflow-hidden">
                        <!-- Background Pattern -->
                        <div class="absolute inset-0 opacity-5">
                            <div class="absolute top-10 left-10 w-20 h-20 bg-primary rounded-full"></div>
                            <div class="absolute bottom-10 right-10 w-16 h-16 bg-secondary rounded-full"></div>
                            <div
                                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-gradient-to-br from-primary to-secondary rounded-full"></div>
                        </div>

                        <div class="relative z-10">
                            <!-- Empty State Icon -->
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-gray/20 to-gray/10 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="1.5" class="w-10 h-10 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"/>
                                </svg>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-700 dark:text-gray-200 mb-3">
                                No Categories Yet
                            </h3>
                            <p class="text-gray-500 dark:text-gray-400 text-lg max-w-md mx-auto">
                                Categories will appear here once they're created. Check back soon for exciting
                                discussions!
                            </p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </section>
</x-app-layout>
