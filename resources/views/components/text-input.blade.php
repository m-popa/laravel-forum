@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge([
      'class' =>
        'py-2 px-3 rounded-md shadow-sm outline-none
         border bg-white text-gray-900
         focus:border-primary focus:ring-1 focus:ring-primary
         dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
         dark:focus:border-primary dark:focus:ring-primary'
    ]) }}
>
