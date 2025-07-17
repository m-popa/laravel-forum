<div>
    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white my-6">
        {{ __('Profile') }}
    </h2>
    
    <form wire:submit="create" class="mt-4">
        {{ $this->form }}

        <button type="submit"
                class="mt-4 whitespace-nowrap rounded-xl bg-primary border border-primary px-4 py-2 text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-primary-dark dark:border-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark">
            Update
        </button>
    </form>

    <x-filament-actions::modals/>
</div>
