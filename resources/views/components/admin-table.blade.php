<div class="overflow-x-auto rounded-lg shadow">
    <table {{ $attributes->merge(['class' => 'min-w-full text-sm text-left border border-gray-200 dark:border-gray-700']) }}>
        <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200">
            {{ $header ?? '' }}
        </thead>

        <tbody class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100">
            {{ $slot }}
        </tbody>
    </table>
</div>
