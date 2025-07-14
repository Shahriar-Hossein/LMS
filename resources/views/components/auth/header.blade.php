@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center">
    <h1 class="text-3xl md:text-4xl font-bold text-emerald-600 dark:text-emerald-400">
        {{ $title }}
    </h1>
    <p class="mt-2 text-cyan-800 dark:text-cyan-300 text-base md:text-lg">
        {{ $description }}
    </p>
</div>
