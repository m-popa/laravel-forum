@props([
    'title' => 'Missing title',
    'subtitle' => 'Missing subtitle',
])

<section {{ $attributes->merge(['class' => 'bg-secondary text-primary border-b border-secondary']) }}>
    <div class="py-12 px-4 mx-auto max-w-screen-xl text-center lg:py-20 lg:px-12">
        <!-- Title -->
        <h1 class="mb-6 text-4xl font-extrabold tracking-tight leading-tight md:text-5xl lg:text-6xl text-primary dark:text-primary">
            {{ $title }}
        </h1>

        <!-- Subtitle -->
        <p class="mb-10 text-lg font-medium text-primary lg:text-xl sm:px-16 xl:px-48">
            {{ $subtitle }}
        </p>

        <!-- Slot for CTA -->
        <div class="flex justify-center">
            {{ $slot }}
        </div>
    </div>
</section>
