<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ __('Appearance') }}</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">
                {{ __('Update the appearance settings for your account') }}
            </p>
        </div>

        <div>
            <div class="flex flex-col md:flex-row gap-6">

                <div class="flex-1">
                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
                        <div class="p-6">
                            <div class="mb-4">
                                <label for="theme"
                                       class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ __('Theme') }}
                                    <span id="current-theme"
                                          class="ml-2 text-sm text-violet-700 dark:text-violet-400"></span>
                                </label>

                                <div class="inline-flex rounded-md shadow-sm" role="group">
                                    <button onclick="setAppearance('light')"
                                            class="flex items-center  px-4  text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-violet-700 focus:z-10 focus:ring-2 focus:ring-violet-700 focus:text-violet-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-violet-500 dark:focus:text-white">
                                        <x-heroicon-s-sun
                                            class="p-2 mr-3 w-8 h-8 text-gray-700 bg-gray-100 rounded-md transition cursor-pointer hover:bg-gray-200"/>
                                        {{ __('Light') }}
                                    </button>
                                    <button onclick="setAppearance('dark')"
                                            class="flex items-center  px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-violet-700 focus:z-10 focus:ring-2 focus:ring-violet-700 focus:text-violet-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-violet-500 dark:focus:text-white">
                                        <x-heroicon-s-moon
                                            class="p-2 mr-3 w-8 h-8 text-gray-100 bg-gray-700 rounded-md transition cursor-pointer dark:hover:bg-gray-600"/>
                                        {{ __('Dark') }}
                                    </button>
                                    <button onclick="setAppearance('system')"
                                            class="flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-violet-700 focus:z-10 focus:ring-2 focus:ring-violet-700 focus:text-violet-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-violet-500 dark:focus:text-white">
                                        <x-heroicon-s-cog
                                            class="p-2 mr-3 w-8 h-8 text-gray-700 bg-gray-100 rounded-md transition cursor-pointer hover:bg-gray-200"/>
                                        {{ __('System') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
