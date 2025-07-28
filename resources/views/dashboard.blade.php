<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="mb-10">
            <div class="flex items-center gap-4 mb-4">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-primary to-secondary rounded-xl flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                         stroke="white" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                        Appearance
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">
                        Customize how the interface looks and feels
                    </p>
                </div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div
            class="bg-surface border border-gray rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-300 overflow-hidden">
            <div class="p-8">
                <!-- User Profile Section -->
                <div class="mb-10">
                    <livewire:dashboard.user-profile/>
                </div>

                <!-- Theme Selection Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4 text-primary">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z"/>
                            </svg>
                        </div>
                        <div>
                            <label class="text-lg font-semibold text-gray-900 dark:text-white">
                                Theme Preference
                            </label>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Choose how you'd like the interface to appear
                            </p>
                        </div>
                    </div>

                    <!-- Current Theme Indicator -->
                    <div class="mb-6 p-4 bg-primary/5 border border-primary/20 rounded-lg">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-primary rounded-full animate-pulse"></div>
                            <span class="text-sm text-gray-700 dark:text-gray-200">
                                Currently using:
                                <span id="current-theme" class="font-semibold text-primary"></span>
                            </span>
                        </div>
                    </div>

                    <!-- Theme Options -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- Light Theme -->
                        <button
                            onclick="setAppearance('light')"
                            aria-pressed="false"
                            class="group relative bg-app hover:bg-surface border-2 border-gray hover:border-primary/40 rounded-xl p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:ring-offset-2 focus:ring-offset-surface aria-pressed:bg-primary/5 aria-pressed:border-primary aria-pressed:shadow-lg aria-pressed:shadow-primary/10"
                        >
                            <!-- Selection Indicator -->
                            <div
                                class="absolute top-3 right-3 w-4 h-4 border-2 border-gray-300 rounded-full group-hover:border-primary group-aria-pressed:border-primary transition-colors duration-200">
                                <div
                                    class="w-full h-full bg-primary rounded-full scale-0 group-hover:scale-75 group-aria-pressed:scale-100 transition-transform duration-200"></div>
                            </div>

                            <!-- Selected Badge -->
                            <div
                                class="absolute top-3 left-3 opacity-0 group-aria-pressed:opacity-100 transition-opacity duration-200">
                                <div
                                    class="bg-primary text-white text-xs font-medium px-2 py-1 rounded-full flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                    </svg>
                                    Active
                                </div>
                            </div>

                            <!-- Icon -->
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center mb-4 mx-auto shadow-lg group-hover:shadow-xl group-hover:scale-105 group-aria-pressed:scale-105 group-aria-pressed:shadow-xl transition-all duration-300">
                                <x-heroicon-s-sun class="w-8 h-8 text-white"/>
                            </div>

                            <!-- Content -->
                            <div class="text-center">
                                <h3 class="font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-primary group-aria-pressed:text-primary transition-colors duration-200">
                                    Light
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                    Clean and bright interface for daytime use
                                </p>
                            </div>
                        </button>

                        <!-- Dark Theme -->
                        <button
                            onclick="setAppearance('dark')"
                            aria-pressed="false"
                            class="group relative bg-app hover:bg-surface border-2 border-gray hover:border-primary/40 rounded-xl p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:ring-offset-2 focus:ring-offset-surface aria-pressed:bg-primary/5 aria-pressed:border-primary aria-pressed:shadow-lg aria-pressed:shadow-primary/10"
                        >
                            <!-- Selection Indicator -->
                            <div
                                class="absolute top-3 right-3 w-4 h-4 border-2 border-gray-300 rounded-full group-hover:border-primary group-aria-pressed:border-primary transition-colors duration-200">
                                <div
                                    class="w-full h-full bg-primary rounded-full scale-0 group-hover:scale-75 group-aria-pressed:scale-100 transition-transform duration-200"></div>
                            </div>

                            <!-- Selected Badge -->
                            <div
                                class="absolute top-3 left-3 opacity-0 group-aria-pressed:opacity-100 transition-opacity duration-200">
                                <div
                                    class="bg-primary text-white text-xs font-medium px-2 py-1 rounded-full flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                    </svg>
                                    Active
                                </div>
                            </div>

                            <!-- Icon -->
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-indigo-600 to-purple-700 rounded-2xl flex items-center justify-center mb-4 mx-auto shadow-lg group-hover:shadow-xl group-hover:scale-105 group-aria-pressed:scale-105 group-aria-pressed:shadow-xl transition-all duration-300">
                                <x-heroicon-s-moon class="w-8 h-8 text-white"/>
                            </div>

                            <!-- Content -->
                            <div class="text-center">
                                <h3 class="font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-primary group-aria-pressed:text-primary transition-colors duration-200">
                                    Dark
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                    Easy on the eyes for low-light environments
                                </p>
                            </div>
                        </button>

                        <!-- System Theme -->
                        <button
                            onclick="setAppearance('system')"
                            aria-pressed="false"
                            class="group relative bg-app hover:bg-surface border-2 border-gray hover:border-primary/40 rounded-xl p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:ring-offset-2 focus:ring-offset-surface sm:col-span-1 aria-pressed:bg-primary/5 aria-pressed:border-primary aria-pressed:shadow-lg aria-pressed:shadow-primary/10"
                        >
                            <!-- Selection Indicator -->
                            <div
                                class="absolute top-3 right-3 w-4 h-4 border-2 border-gray-300 rounded-full group-hover:border-primary group-aria-pressed:border-primary transition-colors duration-200">
                                <div
                                    class="w-full h-full bg-primary rounded-full scale-0 group-hover:scale-75 group-aria-pressed:scale-100 transition-transform duration-200"></div>
                            </div>

                            <!-- Selected Badge -->
                            <div
                                class="absolute top-3 left-3 opacity-0 group-aria-pressed:opacity-100 transition-opacity duration-200">
                                <div
                                    class="bg-primary text-white text-xs font-medium px-2 py-1 rounded-full flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                    </svg>
                                    Active
                                </div>
                            </div>

                            <!-- Icon -->
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-primary to-secondary rounded-2xl flex items-center justify-center mb-4 mx-auto shadow-lg group-hover:shadow-xl group-hover:scale-105 group-aria-pressed:scale-105 group-aria-pressed:shadow-xl transition-all duration-300">
                                <x-heroicon-s-cog class="w-8 h-8 text-white"/>
                            </div>

                            <!-- Content -->
                            <div class="text-center">
                                <h3 class="font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-primary group-aria-pressed:text-primary transition-colors duration-200">
                                    System
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                    Automatically match your device settings
                                </p>
                            </div>
                        </button>
                    </div>

                    <!-- Additional Info -->
                    <div class="mt-8 p-4 bg-info/5 border border-info/20 rounded-lg">
                        <div class="flex gap-3">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-info">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-700 dark:text-gray-200">
                                    <span class="font-medium">Pro tip:</span> System theme automatically switches
                                    between light and dark modes based on your device's settings, providing the best
                                    experience throughout the day.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
