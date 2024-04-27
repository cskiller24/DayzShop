<button
    {{ $attributes->merge(['class' => 'px-4 py-2 border border-transparent dark:bg-secondary bg-primary dark:text-primary text-secondary rounded transition-all dark:hover:bg-primary dark:hover:text-secondary hover:bg-secondary hover:text-primary hover:border-primary dark:hover:border-secondary focus:ring-primary-400 focus:outline-none focus:ring-2 dark:focus:ring-secondary-400']) }}>
    {{ $slot }}
</button>
