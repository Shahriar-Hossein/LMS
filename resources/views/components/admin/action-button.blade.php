@props(['variant' => 'secondary'])
@php
$base = 'px-2 py-1 rounded inline-flex items-center gap-2 text-sm transition focus:outline-none focus:ring-2 focus:ring-offset-1';
$variants = [
    'primary' => 'bg-emerald-600 text-white hover:bg-emerald-500',
    'danger' => 'bg-red-600 text-slate-100 hover:bg-red-500',
    'info' => 'bg-cyan-600 text-slate-100 hover:bg-cyan-500',
    'secondary' => 'border bg-white/0 hover:bg-gray-50 dark:hover:bg-gray-800',
];
$classes = $base.' '.($variants[$variant] ?? $variants['secondary']);
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
